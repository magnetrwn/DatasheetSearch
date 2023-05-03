<!-- TODO: da modificare in una sola flex con h2 e p -->
<h2 class="flex flex-col items-center justify-center p-9 mx-auto my-2 text-3xl text-gray-900 font-extrabold">Risultati della Ricerca</h2>
<p class="flex flex-col items-center justify-center mx-auto pt-12 text-gray-400 bg-gray-900">Oppure inserisci il nome di un altro documento!</p>
<div class="p-1 pb-10 text-gray-100 bg-gray-900">
    <?php include("view/search/page-search-bar.html"); ?>
</div>
<?php
    // TODO: lavorando sull'elaboratore dei risultati... questi sono ad esempio
    include("view/search/page-result-block.php");
    include("view/search/page-result-block.php");
    include("view/search/page-result-block.php");
    include("view/search/page-result-block.php");
    include("view/search/page-result-block.php");
?>
