<div class="px-1 lg:px-20 py-6 bg-white odd:bg-gray-200 overflow-hidden">
    <div class="flex items-center px-4 py-6">
        <img src="<?php if(isset($logo)) echo $logo; else echo "static/no-logo.png"; ?>" alt="Logo" class="w-24 mr-12 object-center">
        <div class="flex flex-col">
            <h2 class="text-lg font-semibold"><?php echo $title; ?></h2>
            <p class="text-gray-500 text-sm">
                <?php 
                    if(strlen($subtitle) > 80)
                        echo substr($subtitle, 0, 80)." [...]";
                    else
                        echo $subtitle;
                ?>
            </p>
            <p class="text-gray-500 text-sm">
                Stato: <?php 
                    if(strlen($alttitle) > 80)
                        echo substr($alttitle, 0, 80)." [...]";
                    else
                        echo $alttitle;
                ?>
            </p>
        </div>
        <div class="flex-1"></div>
        <div class="grid">
            <?php 
                while($linksrow = mysqli_fetch_assoc($links))
                    include("view/search/page-search-file.php");
            ?>
        </div>
    </div>
</div>
