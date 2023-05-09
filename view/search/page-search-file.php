<div class="mr-4 flex items-center">
    <p class="text-gray-500 text-sm"><?php echo $linklabel; ?></p>
    <a href="index.php?goto=details&ds=<?php echo $datasheetid; ?>" class="px-4 py-2">
        <!-- Icona download -->
        <!--svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>Download</title><g id="Icon" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Arrow" transform="translate(-384.000000, -98.000000)" fill-rule="nonzero"><g id="arrow_down_circle_line" transform="translate(384.000000, 98.000000)"><path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5935,23.2578 L12.5819,23.2595 L12.5109,23.295 L12.4919,23.2987 L12.4767,23.295 L12.4057,23.2595 C12.3958,23.2564 12.387,23.259 12.3821,23.2649 L12.378,23.2758 L12.3609,23.7031 L12.3659,23.7235 L12.3769,23.7357 L12.4805,23.8097 L12.4953,23.8136 L12.5071,23.8097 L12.6107,23.7357 L12.6233,23.7197 L12.6267,23.7031 L12.6096,23.2758 C12.6076,23.2657 12.601,23.2593 12.5935,23.2578 Z M12.8584,23.1453 L12.8445,23.1473 L12.6598,23.2397 L12.6499,23.2499 L12.6472,23.2611 L12.6651,23.6906 L12.6699,23.7034 L12.6784,23.7105 L12.8793,23.8032 C12.8914,23.8069 12.9022,23.803 12.9078,23.7952 L12.9118,23.7812 L12.8777,23.1665 C12.8753,23.1546 12.8674,23.147 12.8584,23.1453 Z M12.143,23.1473 C12.1332,23.1424 12.1222,23.1453 12.1156,23.1526 L12.1099,23.1665 L12.0758,23.7812 C12.0751,23.7927 12.0828,23.8019 12.0926,23.8046 L12.1083,23.8032 L12.3092,23.7105 L12.3186,23.7024 L12.3225,23.6906 L12.3404,23.2611 L12.3372,23.2485 L12.3278,23.2397 L12.143,23.1473 Z" id="MingCute"></path><path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M12,4 C7.58172,4 4,7.58172 4,12 C4,16.4183 7.58172,20 12,20 C16.4183,20 20,16.4183 20,12 C20,7.58172 16.4183,4 12,4 Z M12.0001,6.75732 C12.5128571,6.75732 12.9355959,7.14335566 12.9933711,7.6406979 L13.0001,7.75732 L13.0001,13.8327 L14.8282,12.0045 C15.2187,11.614 15.8519,11.614 16.2424,12.0045 C16.6028615,12.3649615 16.6305893,12.9322207 16.3255834,13.3244973 L16.2424,13.4187 L12.7069,16.9543 C12.3463462,17.3147615 11.7791651,17.3424893 11.3869011,17.0374834 L11.2927,16.9543 L7.75712,13.4187 C7.36659,13.0282 7.36659,12.395 7.75712,12.0045 C8.1176,11.6440385 8.68483503,11.6163107 9.0771235,11.9213166 L9.17133,12.0045 L11.0001,13.8332 L11.0001,7.75732 C11.0001,7.20503 11.4478,6.75732 12.0001,6.75732 Z" fill="#394353ff"></path></g></g></g></svg-->
        <!-- Icona link -->
        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>Vai alle specifiche</title><g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="File" transform="translate(-672.000000, 0.000000)" fill-rule="nonzero"><g id="link_2_line" transform="translate(672.000000, 0.000000)"><path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"></path><path d="M16.2426,9.87845 C16.6030615,9.51797 17.1703207,9.49024077 17.5625973,9.79526231 L17.6568,9.87845 L19.7781,11.9998 C21.926,14.1477 21.926,17.6301 19.7781,19.7779 C17.6898639,21.8661361 14.340237,21.9241427 12.1819236,19.9519197 L11.9999,19.7779 L9.87861,17.6566 C9.48808,17.2661 9.48808,16.6329 9.87861,16.2424 C10.2390623,15.8819385 10.8063208,15.8542107 11.1985973,16.1592166 L11.2928,16.2424 L13.4141,18.3637 C14.781,19.7306 16.9971,19.7306 18.3639,18.3637 C19.6818857,17.0457143 19.7289566,14.9380096 18.5051128,13.5636154 L18.3639,13.414 L16.2426,11.2927 C15.852,10.9021 15.852,10.269 16.2426,9.87845 Z M9.17136,9.17134 C9.53184923,8.81086 10.0991191,8.78313077 10.4913971,9.08815231 L10.5856,9.17134 L14.8282,13.414 C15.2187,13.8045 15.2187,14.4377 14.8282,14.8282 C14.4677385,15.1886615 13.9004793,15.2163893 13.5082027,14.9113834 L13.414,14.8282 L9.17136,10.5856 C8.78084,10.195 8.78084,9.56187 9.17136,9.17134 Z M4.22175,4.2216 C6.30997639,2.13338333 9.65960305,2.07537731 11.8178797,4.04758194 L11.9999,4.2216 L14.1212,6.34292 C14.5118,6.73344 14.5118,7.36661 14.1212,7.75713 C13.7607385,8.11761923 13.1935645,8.14534917 12.8012224,7.84031982 L12.707,7.75713 L10.5857,5.63581 C9.21888,4.26898 7.0028,4.26898 5.63597,5.63581 C4.31794571,6.95383429 4.27087342,9.06152179 5.49475311,10.4359775 L5.63597,10.5856 L7.75729,12.7069 C8.14781,13.0974 8.14781,13.7306 7.75729,14.1211 C7.39680077,14.4815615 6.82957355,14.5092893 6.43727848,14.2042834 L6.34307,14.1211 L4.22175,11.9998 C2.07387,9.85189 2.07387,6.36948 4.22175,4.2216 Z" fill="#394353ff"></path></g></g></g></svg>
    </a>
</div>