<!-- TODO: da modificare in una sola flex con h2 e p -->
<h2 class="flex flex-col items-center justify-center p-5 pt-11 mx-auto mt-2 text-3xl text-gray-100 bg-gray-900 font-extrabold">
    <?php echo $welcome; ?>
</h2>
<p class="flex flex-col items-center justify-center mx-auto text-gray-400 bg-gray-900">
    Cerca tutti i datasheet, listini o componenti che ti servono!
</p>
<div class="p-1 pb-10 text-gray-100 bg-gray-900">
    <?php include("view/search/page-search-bar.html"); ?>
</div>
<div class="flex bg-gray-900">
    <div class="flex-1"></div>
    <button id="home-tb1" class="tab-button rounded ml-12 mr-12 py-2 px-24 text-gray-400 bg-gray-900 text-sm" onclick="openTab(this.id, 'home-tc1')">Realta di riferimento</button>
    <button id="home-tb2" class="tab-button rounded py-2 px-24 text-gray-400 bg-gray-900 text-sm" onclick="openTab(this.id, 'home-tc2')">Schema concettuale</button>
    <button id="home-tb3" class="tab-button rounded ml-12 mr-12 py-2 px-24 text-gray-400 bg-gray-900 text-sm" onclick="openTab(this.id, 'home-tc3')">Schema logico e fisico</button>
    <div class="flex-1"></div>
</div>
<div class="p-1 bg-gray-900"></div>
<div id="home-tc1" class="tab-content hidden py-2">
    <h2 class="text-gray-600 my-4 lg:m-6 text-2xl lg:text-3xl">Documentazione</h2>
    <iframe width="100%" height="800" src="static/document/riferimento.pdf"></iframe>
</div>
<div id="home-tc2" class="tab-content hidden py-2">
    <h2 class="text-gray-600 my-4 lg:m-6 text-2xl lg:text-3xl">Schema concettuale</h2>
    <img class="object-contain mt-8 mr-8" src="static/img/er.png" alt="Schema concettuale (ER) in formato PNG.">
</div>
<div id="home-tc3" class="tab-content hidden py-2">
    <h2 class="text-gray-600 text-2xl lg:text-3xl mt-4 lg:m-6">Implementazione fisica</h2>
    <a class="text-blue-600 font-extrabold" href="static/sql/dbinit.sql">Scarica il file SQL di inizializzazione del DB!</a>
</div>
<script>
    <?php include_once("util-tabs.js"); ?>
    openTabByIndex(1);
</script>
