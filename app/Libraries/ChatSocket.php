<?php

namespace App\Libraries;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/path/to/CodeIgniter/bootstrap.php'; // Path ke bootstrap CI4 Anda

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Models\ChatKonsultasiModel;

class ChatSocket implements MessageComponentInterface
{
    protected $clients;
    protected $ChatKonsultasiModel;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->ChatKonsultasiModel = new ChatKonsultasiModel(); // Inisialisasi model Chat
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true); // Decode pesan JSON
        if (isset($data['kd_pesan'], $data['sender'], $data['message'])) {
            // Simpan pesan ke database
            $this->ChatKonsultasiModel->insert([
                'kd_pesan'   => $data['kd_pesan'],
                'sender'     => $data['sender'],
                'sender_id'  => $data['sender_id'], // Ambil ID pengirim
                'message'    => $data['message'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        // Kirim pesan ke klien lain
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
