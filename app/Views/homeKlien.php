<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <title>Bercerita.Com</title>
</head>

<body>
    <div class="beranda">
        <div class="offcanvas offcanvas-end" id="sidebar">
            <div class="offcanvas-header d-flex justify-content-center align-items-center">
                <div class="offcanvas-title">
                    <?= strtoupper($userData['username']) ?> <img src="<?= base_url($userData['foto']) ?>" alt="Foto Profil" class="profile rounded-circle">
                </div>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/editProfile" class="nav-link">
                            <svg width="32" height="32" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8333 23.9583C23.0435 23.9583 25.1631 23.0803 26.7259 21.5175C28.2887 19.9547 29.1667 17.8351 29.1667 15.625C29.1667 13.4149 28.2887 11.2952 26.7259 9.73243C25.1631 8.16963 23.0435 7.29166 20.8333 7.29166C18.6232 7.29166 16.5036 8.16963 14.9408 9.73243C13.378 11.2952 12.5 13.4149 12.5 15.625C12.5 17.8351 13.378 19.9547 14.9408 21.5175C16.5036 23.0803 18.6232 23.9583 20.8333 23.9583ZM20.8333 21.875C21.6541 21.875 22.4668 21.7133 23.2251 21.3992C23.9834 21.0851 24.6724 20.6248 25.2528 20.0444C25.8331 19.464 26.2935 18.775 26.6076 18.0168C26.9217 17.2585 27.0833 16.4458 27.0833 15.625C27.0833 14.8042 26.9217 13.9915 26.6076 13.2332C26.2935 12.4749 25.8331 11.7859 25.2528 11.2056C24.6724 10.6252 23.9834 10.1648 23.2251 9.85074C22.4668 9.53665 21.6541 9.37499 20.8333 9.37499C19.1757 9.37499 17.586 10.0335 16.4139 11.2056C15.2418 12.3777 14.5833 13.9674 14.5833 15.625C14.5833 17.2826 15.2418 18.8723 16.4139 20.0444C17.586 21.2165 19.1757 21.875 20.8333 21.875Z" fill="black" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M41.6667 20.8333C41.6667 32.3396 32.3396 41.6667 20.8333 41.6667C9.32708 41.6667 0 32.3396 0 20.8333C0 9.32708 9.32708 0 20.8333 0C32.3396 0 41.6667 9.32708 41.6667 20.8333ZM30.8646 36.6771C27.8659 38.5816 24.3857 39.5899 20.8333 39.5833C17.1962 39.5899 13.6365 38.5326 10.5927 36.5417C10.3427 36.2292 10.0892 35.9062 9.83229 35.5729C9.53427 35.1825 9.37352 34.7047 9.375 34.2135C9.375 33.0917 10.1812 32.151 11.2594 31.9937C18.3896 30.9521 23.299 31.0417 30.4385 32.0302C30.9553 32.1058 31.4274 32.3655 31.7679 32.7615C32.1084 33.1575 32.2944 33.6632 32.2917 34.1854C32.2917 34.6854 32.1198 35.1708 31.8094 35.55C31.4892 35.9396 31.1743 36.3153 30.8646 36.6771ZM34.3594 33.8187C34.1927 31.8687 32.7125 30.2417 30.724 29.9667C23.4156 28.9552 18.3073 28.8583 10.9583 29.9323C8.95833 30.224 7.48438 31.8656 7.30937 33.8208C3.95034 30.3324 2.07671 25.6761 2.08333 20.8333C2.08333 10.4781 10.4781 2.08333 20.8333 2.08333C31.1885 2.08333 39.5833 10.4781 39.5833 20.8333C39.59 25.6751 37.7171 30.3305 34.3594 33.8187Z" fill="black" />
                            </svg> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/todolist" class="nav-link">
                            <svg width="32" height="32" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M29.1667 12.3125L19.7917 2.93747L5.02083 17.7083H8.33333V34.375H14.5833V21.875H25V34.375H31.25V17.7083H34.5625L31.25 14.3958V7.29164H29.1667V12.3125ZM0 19.7916L19.7917 -3.05176e-05L27.0833 7.29164V5.2083H33.3333V13.5416L39.5833 19.7916H33.3333V36.4583H22.9167V23.9583H16.6667V36.4583H6.25V19.7916H0Z" fill="black" />
                            </svg> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/konsultasi" class="nav-link">
                            <!-- <button class="nav-link" type="button"> data-bs-toggle="collapse" data-bs-target="#accordion" -->
                            <svg width="32" height="32" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.639 26.7222C23.639 26.9948 23.5307 27.2562 23.338 27.449C23.1452 27.6417 22.8838 27.75 22.6112 27.75H8.22233C7.99622 27.75 7.78039 27.9555 7.59539 28.0892L4.11122 30.8333V14.3889C4.11122 14.1163 4.2195 13.8549 4.41225 13.6621C4.60499 13.4694 4.86641 13.3611 5.139 13.3611H9.10622V11.3055H5.139C4.32125 11.3055 3.53699 11.6304 2.95875 12.2086C2.38051 12.7869 2.05566 13.5711 2.05566 14.3889V32.8889C2.05719 33.0798 2.11185 33.2664 2.21351 33.428C2.31516 33.5896 2.4598 33.7196 2.63122 33.8036C2.79636 33.8787 2.97844 33.9088 3.15896 33.8907C3.33947 33.8726 3.512 33.8071 3.659 33.7008L8.95205 29.8055H22.7654C23.1549 29.8171 23.5427 29.7485 23.9046 29.604C24.2666 29.4596 24.595 29.2424 24.8696 28.9659C25.1442 28.6894 25.3591 28.3594 25.501 27.9964C25.6429 27.6335 25.7088 27.2453 25.6945 26.8558V25.6944H23.639V26.7222Z" fill="black" />
                                <path d="M31.8612 4.11111H14.389C13.5712 4.11111 12.787 4.43596 12.2088 5.0142C11.6305 5.59244 11.3057 6.3767 11.3057 7.19445V19.5278C11.3057 20.3455 11.6305 21.1298 12.2088 21.708C12.787 22.2863 13.5712 22.6111 14.389 22.6111H28.3154L33.2282 26.4242C33.3742 26.5321 33.5463 26.5995 33.7268 26.6194C33.9073 26.6392 34.0899 26.6109 34.2559 26.5372C34.4308 26.4539 34.5786 26.3229 34.6823 26.1592C34.7859 25.9956 34.8412 25.8059 34.8418 25.6122V7.19445C34.8422 6.3942 34.5315 5.62512 33.9753 5.04975C33.4191 4.47438 32.661 4.13779 31.8612 4.11111ZM32.889 23.5772L29.2918 20.7714C29.1124 20.6322 28.8919 20.5563 28.6648 20.5556H14.389C14.1164 20.5556 13.855 20.4473 13.6622 20.2545C13.4695 20.0618 13.3612 19.8004 13.3612 19.5278V7.19445C13.3612 6.92186 13.4695 6.66045 13.6622 6.4677C13.855 6.27495 14.1164 6.16667 14.389 6.16667H31.8612C32.136 6.1916 32.3921 6.31613 32.5814 6.51679C32.7707 6.71745 32.8801 6.9804 32.889 7.25611V23.5772Z" fill="black" />
                            </svg> Konsultasi
                            <!-- </button> -->
                            <!-- <div class="collapse" id="accordion">
                                <img src="<?= base_url('images/psikolog1.jpeg') ?>" class="profile rounded-circle"> Alex Kurniawan M.Psi
                            </div> -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/jejakPerasaan" class="nav-link">
                            <svg width="32" height="32" viewBox="0 0 38 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5771 28.5271C12.0049 28.5271 11.5153 28.3223 11.1083 27.9125C10.7014 27.5028 10.4972 27.0125 10.4958 26.4417V22.275H16.2646V15.5042C14.9424 15.782 13.5875 15.7403 12.2 15.3792C10.8125 15.0167 9.66736 14.3799 8.76458 13.4688V10.5375H5.80625L0 4.72711C1.19722 3.63822 2.55556 2.82364 4.075 2.28336C5.59444 1.74309 7.15764 1.47364 8.76458 1.47503C10.0993 1.47503 11.3972 1.66461 12.6583 2.04378C13.9194 2.42295 15.1215 3.01739 16.2646 3.82711V3.05176e-05H37.0979V24.3584C37.0979 25.5347 36.6972 26.5229 35.8958 27.3229C35.0944 28.1229 34.1063 28.5243 32.9312 28.5271H12.5771ZM18.3479 22.2771H30.8479V24.3604C30.8479 24.9493 31.0479 25.4438 31.4479 25.8438C31.8479 26.2438 32.3424 26.4431 32.9312 26.4417C33.5201 26.4403 34.0153 26.241 34.4167 25.8438C34.8181 25.4466 35.0174 24.9514 35.0146 24.3584V2.08336H18.3479V5.4167L29.8062 16.875V18.35H28.3312L21.9937 12.0104L20.8167 13.1896C20.4097 13.5952 20.0104 13.9354 19.6187 14.2104C19.2271 14.4854 18.8035 14.7271 18.3479 14.9354V22.2771ZM6.69792 8.45211H10.8479V12.5292C11.559 12.9681 12.2201 13.2667 12.8313 13.425C13.4424 13.5834 14.0368 13.6618 14.6146 13.6604C15.5632 13.6604 16.425 13.4986 17.2 13.175C17.9764 12.8514 18.7035 12.3507 19.3813 11.6729L20.5187 10.5354L16.8812 6.89795C15.7674 5.78406 14.5188 4.94864 13.1354 4.3917C11.7521 3.83475 10.2951 3.55697 8.76458 3.55836C7.75069 3.55836 6.76389 3.69031 5.80417 3.9542C4.84583 4.21809 3.98681 4.56114 3.22708 4.98336L6.69792 8.45211ZM28.7646 24.3584H12.5771V26.4417H29.3979C29.1604 26.157 28.9951 25.8361 28.9021 25.4792C28.8104 25.1236 28.7646 24.7507 28.7646 24.3604" fill="black" />
                            </svg> Jejak Perasaan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/forumKlien" class="nav-link">
                            <svg width="32" height="32" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M30.0082 26.601C29.8103 24.3771 29.4103 22.3771 28.5187 20.8708L31.6968 17.6927C33.3313 17.5868 34.859 16.8433 35.951 15.6225C37.043 14.4016 37.612 12.8008 37.5357 11.1646C37.4594 9.5284 36.7438 7.98754 35.5429 6.8736C34.342 5.75966 32.7518 5.16168 31.1145 5.20833C30.3291 2.25312 26.2583 0 21.3541 0C17.0166 0 13.3301 1.7625 11.9947 4.21562C8.1645 4.58437 5.20825 6.98646 5.20825 9.89583C5.20825 13.0604 8.70617 15.625 13.0208 15.625C15.0968 15.625 16.9833 15.0312 18.3833 14.0625C18.4388 14.1667 18.4989 14.276 18.5635 14.3906C19.0405 15.2448 19.7301 16.3906 20.576 17.5437C21.4176 18.6896 22.4405 19.8771 23.5905 20.7885C24.5666 21.5604 25.7041 22.1885 26.951 22.3552C27.4593 23.424 27.7655 24.8969 27.9322 26.7854C28.1249 28.9427 28.1249 31.4958 28.1249 34.375V35.4167H30.2083V34.3385C30.2083 31.5021 30.2083 28.8594 30.0082 26.601ZM27.102 11.8583C27.0736 11.5593 26.9809 11.2699 26.8302 11.01C26.6794 10.7502 26.4743 10.526 26.2288 10.3528C25.9833 10.1797 25.7033 10.0617 25.408 10.0069C25.1126 9.95209 24.8089 9.96182 24.5176 10.0354C23.4829 10.2926 22.4203 10.4206 21.3541 10.4167C20.9603 10.4167 20.5746 10.4003 20.1968 10.3677C19.828 10.3363 19.4575 10.4037 19.1233 10.5629C18.7892 10.7222 18.5035 10.9676 18.2958 11.274C17.4937 12.4583 15.5728 13.5417 13.0208 13.5417C11.2603 13.5417 9.74992 13.0156 8.72909 12.2667C7.70617 11.5167 7.29159 10.6552 7.29159 9.89583C7.29159 8.54583 8.86763 6.60938 12.1937 6.28958C12.5327 6.25701 12.8587 6.14178 13.1429 5.95401C13.4271 5.76623 13.6609 5.51163 13.8239 5.2125C14.6458 3.70312 17.4062 2.08333 21.3541 2.08333C23.503 2.08333 25.3989 2.57917 26.7895 3.32917C28.2103 4.09583 28.9041 5.00625 29.0999 5.74375C29.2196 6.19534 29.4877 6.59358 29.861 6.87449C30.2343 7.15541 30.6912 7.3027 31.1582 7.29271L31.2499 7.29167C31.9139 7.29182 32.5683 7.45066 33.1585 7.75496C33.7486 8.05927 34.2575 8.50021 34.6428 9.04105C35.028 9.5819 35.2784 10.207 35.3731 10.8642C35.4677 11.5214 35.404 12.1918 35.1871 12.8193C34.9702 13.4469 34.6064 14.0136 34.1262 14.4721C33.6459 14.9306 33.063 15.2677 32.426 15.4553C31.789 15.6429 31.1165 15.6755 30.4643 15.5505C29.8122 15.4254 29.1994 15.1463 28.677 14.7365L28.327 14.4281C27.6281 13.743 27.1942 12.8327 27.102 11.8583ZM25.9562 14.7823C25.4387 13.9579 25.1208 13.0241 25.028 12.0552C24.3739 12.2208 23.6853 12.3427 22.9708 12.4167C21.9901 12.5188 21.002 12.5278 20.0197 12.4437L19.9416 12.5563C20.0541 12.7729 20.202 13.0521 20.3833 13.376C20.9777 14.4485 21.6416 15.4809 22.3708 16.4667V16.3146C23.5218 16.3146 24.7301 15.6927 25.7322 14.9521C25.8093 14.8965 25.8839 14.8399 25.9562 14.7823ZM23.8385 18.2031C24.178 18.551 24.526 18.8729 24.8833 19.1552C25.3971 19.5622 25.8971 19.8642 26.3832 20.0615L29.1114 17.3323C28.4731 17.0995 27.8771 16.7642 27.3468 16.3396C27.2267 16.4354 27.101 16.5319 26.9697 16.6292C26.1614 17.225 25.0718 17.8844 23.8385 18.2031Z" fill="black" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5022 20.3125C12.5025 20.6545 12.4355 20.9932 12.305 21.3093C12.1744 21.6254 11.9829 21.9126 11.7413 22.1547C11.4997 22.3967 11.2128 22.5889 10.897 22.72C10.5812 22.8512 10.2426 22.9189 9.90064 22.9193C9.55865 22.9196 9.21995 22.8526 8.90387 22.722C8.58778 22.5915 8.30051 22.3999 8.05845 22.1584C7.81639 21.9168 7.62428 21.6299 7.49309 21.3141C7.36191 20.9983 7.29421 20.6597 7.29387 20.3177C7.29317 19.627 7.56688 18.9644 8.05477 18.4755C8.54265 17.9867 9.20476 17.7116 9.89543 17.7109C10.5861 17.7102 11.2487 17.984 11.7376 18.4718C12.2265 18.9597 12.5015 19.6218 12.5022 20.3125ZM10.4189 20.3146C10.4189 20.383 10.4055 20.4507 10.3794 20.5139C10.3533 20.5772 10.315 20.6346 10.2667 20.683C10.2184 20.7314 10.161 20.7699 10.0978 20.7961C10.0347 20.8223 9.96695 20.8359 9.89855 20.8359C9.83016 20.836 9.76241 20.8226 9.6992 20.7965C9.63598 20.7704 9.57853 20.7321 9.53011 20.6838C9.4817 20.6354 9.44328 20.5781 9.41704 20.5149C9.39081 20.4517 9.37727 20.384 9.3772 20.3156C9.37706 20.1775 9.4318 20.045 9.52938 19.9472C9.62696 19.8494 9.75938 19.7944 9.89751 19.7943C10.0356 19.7941 10.1682 19.8489 10.2659 19.9465C10.3637 20.044 10.4187 20.1765 10.4189 20.3146ZM5.21053 24.4792C5.21087 24.8212 5.14385 25.1599 5.0133 25.4759C4.88274 25.792 4.69121 26.0793 4.44963 26.3214C4.20805 26.5634 3.92116 26.7555 3.60534 26.8867C3.28952 27.0179 2.95095 27.0856 2.60897 27.0859C2.26699 27.0863 1.92828 27.0193 1.6122 26.8887C1.29612 26.7581 1.00884 26.5666 0.766783 26.325C0.524722 26.0835 0.332613 25.7966 0.201426 25.4807C0.070238 25.1649 0.00254055 24.8264 0.00219857 24.4844C0.0015079 23.7937 0.275212 23.1311 0.7631 22.6422C1.25099 22.1533 1.91309 21.8783 2.60376 21.8776C3.29443 21.8769 3.95708 22.1506 4.44595 22.6385C4.93481 23.1264 5.20984 23.7885 5.21053 24.4792ZM3.1272 24.4813C3.1272 24.6194 3.07233 24.7519 2.97465 24.8495C2.87698 24.9472 2.7445 25.0021 2.60636 25.0021C2.46823 25.0021 2.33576 24.9472 2.23808 24.8495C2.14041 24.7519 2.08553 24.6194 2.08553 24.4813C2.08553 24.3431 2.14041 24.2106 2.23808 24.113C2.33576 24.0153 2.46823 23.9604 2.60636 23.9604C2.7445 23.9604 2.87698 24.0153 2.97465 24.113C3.07233 24.2106 3.1272 24.3431 3.1272 24.4813ZM20.3168 27.0854C21.0074 27.0849 21.6696 26.81 22.1576 26.3212C22.6456 25.8324 22.9194 25.1698 22.9189 24.4792C22.9183 23.7885 22.6434 23.1263 22.1546 22.6384C21.6659 22.1504 21.0033 21.8765 20.3126 21.8771C19.6219 21.8776 18.9598 22.1525 18.4718 22.6413C17.9838 23.1301 17.71 23.7927 17.7105 24.4833C17.7111 25.174 17.986 25.8362 18.4747 26.3241C18.9635 26.8121 19.6261 27.086 20.3168 27.0854ZM20.3147 25.0021C20.4528 25.0021 20.5853 24.9472 20.683 24.8495C20.7807 24.7519 20.8355 24.6194 20.8355 24.4813C20.8355 24.3431 20.7807 24.2106 20.683 24.113C20.5853 24.0153 20.4528 23.9604 20.3147 23.9604C20.1766 23.9604 20.0441 24.0153 19.9464 24.113C19.8487 24.2106 19.7939 24.3431 19.7939 24.4813C19.7939 24.6194 19.8487 24.7519 19.9464 24.8495C20.0441 24.9472 20.1766 25.0021 20.3147 25.0021Z" fill="black" />
                                <path d="M9.375 23.9583C9.92753 23.9583 10.4574 24.1778 10.8481 24.5685C11.2388 24.9592 11.4583 25.4891 11.4583 26.0416V28.125H13.5417C14.0942 28.125 14.6241 28.3445 15.0148 28.7352C15.4055 29.1259 15.625 29.6558 15.625 30.2083C15.625 30.7608 15.4055 31.2908 15.0148 31.6815C14.6241 32.0722 14.0942 32.2916 13.5417 32.2916H9.375C8.82246 32.2916 8.29256 32.0722 7.90186 31.6815C7.51116 31.2908 7.29167 30.7608 7.29167 30.2083V26.0416C7.29167 25.4891 7.51116 24.9592 7.90186 24.5685C8.29256 24.1778 8.82246 23.9583 9.375 23.9583ZM4.16667 30.2083C4.16667 29.6558 3.94717 29.1259 3.55647 28.7352C3.16577 28.3445 2.63587 28.125 2.08333 28.125C1.5308 28.125 1.00089 28.3445 0.610194 28.7352C0.219493 29.1259 0 29.6558 0 30.2083V35.4166C0 35.9692 0.219493 36.4991 0.610194 36.8898C1.00089 37.2805 1.5308 37.5 2.08333 37.5H6.25C6.80253 37.5 7.33244 37.2805 7.72314 36.8898C8.11384 36.4991 8.33333 35.9692 8.33333 35.4166C8.33333 34.8641 8.11384 34.3342 7.72314 33.9435C7.33244 33.5528 6.80253 33.3333 6.25 33.3333H4.16667V30.2083ZM20.8333 28.125C20.2808 28.125 19.7509 28.3445 19.3602 28.7352C18.9695 29.1259 18.75 29.6558 18.75 30.2083V33.3333H16.6667C16.1141 33.3333 15.5842 33.5528 15.1935 33.9435C14.8028 34.3342 14.5833 34.8641 14.5833 35.4166C14.5833 35.9692 14.8028 36.4991 15.1935 36.8898C15.5842 37.2805 16.1141 37.5 16.6667 37.5H20.8333C21.3859 37.5 21.9158 37.2805 22.3065 36.8898C22.6972 36.4991 22.9167 35.9692 22.9167 35.4166V30.2083C22.9167 29.6558 22.6972 29.1259 22.3065 28.7352C21.9158 28.3445 21.3859 28.125 20.8333 28.125Z" fill="black" />
                            </svg> Ruang Cerita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <svg width="32" height="32" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M37.3736 32.0954C37.3534 32.8144 37.1889 33.5221 36.8899 34.1764C36.5908 34.8306 36.1634 35.4181 35.6328 35.9039C35.1023 36.3898 34.4796 36.764 33.8016 37.0045C33.1236 37.2449 32.4042 37.3467 31.6861 37.3037C27.2007 37.3287 22.7153 37.3037 18.2299 37.3037C17.9536 37.3037 17.6887 37.194 17.4933 36.9986C17.298 36.8033 17.1882 36.5383 17.1882 36.262C17.1882 35.9858 17.298 35.7208 17.4933 35.5255C17.6887 35.3301 17.9536 35.2204 18.2299 35.2204C22.8132 35.2204 27.3966 35.287 31.9799 35.2204C34.2861 35.187 35.2903 33.4537 35.2903 31.3912V5.42662C35.3052 4.77117 35.1203 4.1267 34.76 3.57891C34.3998 3.03112 33.8814 2.60596 33.2736 2.35995C32.5545 2.16265 31.8059 2.09562 31.0632 2.16204H18.2299C17.9536 2.16204 17.6887 2.05229 17.4933 1.85694C17.298 1.66159 17.1882 1.39664 17.1882 1.12037C17.1882 0.844103 17.298 0.579151 17.4933 0.383801C17.6887 0.188451 17.9536 0.0787037 18.2299 0.0787037C22.8632 0.0787037 27.532 -0.0983796 32.1611 0.0787037C32.87 0.096632 33.5683 0.255366 34.2153 0.545669C34.8623 0.835973 35.445 1.25205 35.9297 1.76968C36.4144 2.28732 36.7913 2.89618 37.0385 3.56083C37.2856 4.22548 37.3982 4.93266 37.3695 5.6412L37.3736 32.0954Z" fill="black" />
                                <path d="M0.307013 17.96C0.131893 18.1313 0.0290155 18.3631 0.0195126 18.6079C0.0222904 18.6371 0.0181237 18.6669 0.00701254 18.6975C-0.00965413 18.7433 0.00701263 18.7537 0.0195126 18.7829C0.0284885 19.0284 0.131407 19.2611 0.307013 19.4329L7.95076 27.0766C8.14722 27.2664 8.41035 27.3714 8.68347 27.369C8.95659 27.3666 9.21786 27.2571 9.41099 27.0639C9.60412 26.8708 9.71367 26.6096 9.71605 26.3364C9.71842 26.0633 9.61343 25.8002 9.42368 25.6037L3.5591 19.7371H25.9383C26.2145 19.7371 26.4795 19.6273 26.6748 19.432C26.8702 19.2366 26.9799 18.9717 26.9799 18.6954C26.9799 18.4191 26.8702 18.1542 26.6748 17.9588C26.4795 17.7635 26.2145 17.6537 25.9383 17.6537H3.5591L9.42368 11.7871C9.61343 11.5906 9.71842 11.3275 9.71605 11.0543C9.71367 10.7812 9.60412 10.52 9.41099 10.3268C9.21786 10.1337 8.95659 10.0241 8.68347 10.0218C8.41035 10.0194 8.14722 10.1244 7.95076 10.3141L0.307013 17.96Z" fill="black" />
                            </svg> Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark navbar-overlay" id="beranda">
            <div class="container-fluid">
                <a class="navbar-brand" href="#tentangKami">
                    <img src="<?= base_url('images/Logo Bercerita.com.png') ?>" alt="Bercerita.com" class="logo">
                </a>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-label="Buka menu samping">
                            <?= strtoupper($userData['username']) ?>
                            <img src="<?= base_url($userData['foto']) ?>" alt="Foto Profil" class="profile rounded-circle">
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="demo" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="6"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="7"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= base_url('images/Burnout.png') ?>" alt="Burnout" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Burnout: Ketika Kelelahan Mental Menjadi Hambatan</h3>
                        <p>Burnout adalah kondisi kelelahan fisik, emosional, dan mental akibat tekanan pekerjaan atau tanggung jawab berlebih.
                            Tanda-tanda burnout termasuk kelelahan ekstrem, kehilangan motivasi, dan merasa tidak produktif meski telah bekerja keras.
                            Dengan mengenali gejalanya lebih awal, kita bisa mengambil langkah-langkah seperti istirahat, menjaga keseimbangan hidup,
                            dan meminta dukungan agar terhindar dari dampak negatif yang lebih serius.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Loneliness.png') ?>" alt="Loneliness" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Kesepian: Memahami Perasaan yang Menghantui</h3>
                        <p>Kesepian adalah pengalaman emosional yang dapat dialami oleh siapa saja, meskipun dikelilingi oleh orang lain.
                            Hal ini dapat timbul dari perasaan terputus dari lingkungan sosial, kehilangan koneksi dengan teman, atau
                            bahkan ketidakmampuan untuk berkomunikasi dengan orang lain. Mempelajari kesepian penting untuk memahami dampaknya
                            terhadap kesehatan mental dan fisik kita, serta mencari cara untuk mengatasinya melalui dukungan sosial dan pengembangan
                            diri.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Anxiety.png') ?>" alt="Anxiety" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Kecemasan: Menghadapi Perasaan Takut yang Berlebihan</h3>
                        <p>Kecemasan adalah perasaan ketakutan atau kekhawatiran yang sering muncul tanpa alasan yang jelas.
                            Ini bisa membuat seseorang merasa gelisah, tegang, atau khawatir tentang hal-hal sehari-hari.
                            Meskipun kecemasan adalah respons normal terhadap stres, jika berlebihan, bisa mengganggu kehidupan sehari-hari.
                            Memahami kecemasan penting untuk mengenali gejalanya dan mencari bantuan, sehingga kita dapat mengelola
                            perasaan ini dengan lebih baik dan meningkatkan kualitas hidup.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Frustasi.png') ?>" alt="Frustasi" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Frustrasi: Ketika Harapan Tidak Sesuai Kenyataan</h3>
                        <p>Frustrasi adalah perasaan kesal atau kecewa yang muncul ketika sesuatu tidak berjalan sesuai harapan.
                            Hal ini bisa disebabkan oleh berbagai hal, seperti kegagalan mencapai tujuan atau hambatan yang muncul dalam perjalanan hidup.
                            Frustrasi adalah emosi yang normal, tetapi jika tidak dikelola dengan baik, dapat memengaruhi kesehatan mental dan fisik.
                            Memahami frustrasi dapat membantu kita menemukan cara untuk tetap tenang, bersabar, dan mencari solusi yang lebih efektif.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Trauma.png') ?>" alt="Trauma" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Trauma: Luka Emosional yang Tersimpan di Dalam Diri</h3>
                        <p>Trauma adalah respons emosional terhadap peristiwa yang sangat mengejutkan atau menyakitkan, seperti kecelakaan,
                            kekerasan, atau kehilangan. Pengalaman ini bisa meninggalkan bekas yang mendalam dan mempengaruhi cara seseorang
                            memandang dunia serta dirinya sendiri. Trauma tidak selalu terlihat dari luar, namun dapat berdampak jangka panjang
                            pada kesehatan mental dan fisik. Memahami trauma adalah langkah penting untuk proses penyembuhan dan menemukan
                            dukungan yang dibutuhkan untuk pulih.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Hopeless.png') ?>" alt="Hopeless" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Putus Asa: Saat Harapan Mulai Hilang</h3>
                        <p>Putus asa adalah perasaan kehilangan harapan atau keyakinan bahwa keadaan akan membaik.
                            Ini bisa muncul setelah mengalami kegagalan, kehilangan, atau situasi sulit yang tampaknya
                            tidak ada jalan keluarnya. Perasaan ini dapat membuat seseorang merasa terjebak dan tidak
                            mampu melihat kemungkinan perubahan positif. Penting untuk memahami bahwa meskipun putus asa
                            bisa sangat menyakitkan, ada cara untuk menemukan kembali harapan dengan dukungan dan langkah-langkah
                            kecil menuju pemulihan.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Family & Relation.png') ?>" alt="Family & Relation" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Keluarga & Hubungan: Fondasi Penting dalam Kehidupan</h3>
                        <p>Keluarga dan hubungan merupakan pilar utama yang memberikan dukungan emosional, rasa aman, dan kebahagiaan dalam hidup.
                            Hubungan yang sehat dalam keluarga dan dengan orang lain membantu seseorang merasa dihargai dan dicintai.
                            Namun, seperti halnya semua hubungan, tantangan dan konflik bisa terjadi.
                            Memahami pentingnya komunikasi yang baik, empati, dan saling pengertian adalah kunci untuk membangun dan menjaga
                            hubungan yang harmonis dan kuat dalam keluarga dan lingkungan sosial.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Jealousy.png') ?>" alt="Jealousy" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Cemburu: Mengelola Perasaan Iri yang Mengganggu</h3>
                        <p>Cemburu adalah emosi yang muncul ketika seseorang merasa takut kehilangan perhatian, cinta, atau kedudukan karena orang lain.
                            Perasaan ini bisa timbul dalam berbagai hubungan, baik itu pertemanan, keluarga, atau percintaan.
                            Meskipun wajar, cemburu yang berlebihan dapat merusak kepercayaan dan hubungan yang sehat.
                            Memahami cemburu membantu kita mengelola emosi ini dengan lebih baik dan memperkuat rasa percaya diri serta hubungan yang kita miliki.</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- Ruang Bercerita -->
    <div class="background-1" id="ruangCerita">
        <div class="container my-5">
            <h1 class="fw-bold text-center">Temukan Ruang yang Cocok Denganmu!</h1>

            <div class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum1.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">Never Alone</h2>
                                <p style="font-weight: 600;">Isolasi Sosial dan Kesepian</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum2.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">You Strong</h2>
                                <p style="font-weight: 600;">Trauma dan Penyembuhan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum3.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">Terus Bernapas!</h2>
                                <p style="font-weight: 600;">Tips dan Dukungan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum4.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">Tempat Pulang!</h2>
                                <p style="font-weight: 600;">Tips dan Dukungan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-3">Lihat Lebih Banyak</button>
            </div>
        </div>
    </div>

    <!-- Jejak Perasaan -->
    <div class="background-2" id="jejakPerasaan">
        <div class="container my-5">
            <h1 class="fw-bold text-center">Bagaimana Perasaanmu Hari Ini?</h1>

            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="card green">
                        <div class="card-body">
                            <p class="card-text">Harus Pulang Kemana???</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card blue">
                        <div class="card-body">
                            <p class="card-text">Teruslah bernapas walau dunia selalu menolakmu</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card yellow">
                        <div class="card-body">
                            <p class="card-text">Aku sudah kehilangan semuanya</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card pink">
                        <div class="card-body">
                            <p class="card-text">Keluarga harusnya menjadi rumah yang nyaman, tapi bagiku tidak</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card pink2">
                        <div class="card-body">
                            <p class="card-text">AKU CAPEK...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card purple">
                        <div class="card-body">
                            <p class="card-text">Melihat orang lain bahagia terasa menyenangkan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card green1">
                        <div class="card-body">
                            <p class="card-text">Tidak ada tempat lagi yang dapat aku sebut rumah</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card purple1">
                        <div class="card-body">
                            <p class="card-text">Apakah orang sepertiku pantas untuk bahagia??</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-primary mt-3">Ayo! Tinggalkan Jejak Perasaanmu</button>
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="background-3" id="tentangKami">
        <div class="container my-5">
            <h1 class="fw-bold text-center">Tentang Kami</h1>

            <div class="row mt-5 header">
                <div class="col-md-6">
                    <h2>Selamat Datang di</h2>
                    <img src="<?= base_url('images/Logo Bercerita.com2.png') ?>" class="logo">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div class="row mt-3">
                    <div class="col-md-7">
                        <div class="body-text">
                            <p>
                                Bercerita.com adalah platform digital yang mendukung kesehatan mental, khususnya bagi kaum muda.
                                Kami menyediakan ruang aman dan anonim untuk berbagi cerita atau mencari dukungan,
                                dengan fitur konsultasi bersama psikolog profesional dan forum diskusi mahasiswa psikologi.
                                Layanan kami mencakup chat pribadi dengan psikolog, penjadwalan konsultasi luring,
                                serta Mading Notes Digital untuk mencatat perasaan secara bebas dalam perjalanan menuju kesejahteraan mental.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="<?= base_url('images/elemenTentangKami.png') ?>" class="ilustrasi">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Home: Psikolog -->
    <div class="background-4" id="konsultasi">
        <div class="container my-5">
            <h1 class="fw-bold title text-center">Mau Mulai Konsultasi?</h1>
            <h1 class="fw-bold title text-center">Yuk Kenali Psikolog Kami!</h1>

            <div class="d-flex justify-content-center mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url('images/psikolog1.jpeg') ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Alex Kurniawan M.Psi</h4>
                                <p class="card-text">Berpengalaman dalam menganani kasus terkait kecemasan dan gangguan depresi.</p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary">Buat Janji</a>
                                    <a href="#" class="detail-link">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url('images/psikolog2.jpeg') ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Nayara Karista M.Psi</h4>
                                <p class="card-text">Berpengalaman dalam menganani kasus terkait kecemasan dan gangguan depresi.</p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary">Buat Janji</a>
                                    <a href="#" class="detail-link">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url('images/psikolog3.jpeg') ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Anindya Mustika M.Psi</h4>
                                <p class="card-text">Berpengalaman menangani kasus terkait ggangguan Mood, Depresi, gangguan Kecemasan, gangguan kepribadian, serta Non Suicidal Self Injury.</p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary">Buat Janji</a>
                                    <a href="#" class="detail-link">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-primary mt-3">Lihat Semua</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="<?= base_url('images/Logo Bercerita.com.png') ?>" alt="Bercerita.com">
        <p>Universitas Sanata Dharma Yogyakarta <br>
            Fakultas Sains & Teknologi <br>
            Kampus III <br>
            Paingan, Maguwoharjo, Kec.Depok <br>
            Daerah Istimewa Yogyakarta 55281 <br> </p>
    </div>
</body>

</html>