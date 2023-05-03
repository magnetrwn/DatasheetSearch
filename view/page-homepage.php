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
<div class="grid gap-4 grid-cols-2 text-gray-600 m-4 lg:m-6">
	<div>
		<h2 class="text-gray-600 my-4 lg:m-6 text-2xl lg:text-3xl">Documentazione</h2>
        <iframe width="480" height="600" src="static/document/riferimento.pdf"></iframe>
	</div>
    <div>
		<h2 class="text-gray-600 my-4 lg:m-6 text-2xl lg:text-3xl">Schema concettuale</h2>
        <img class="object-contain mt-8 mr-8" src="static/img/er.png" alt="Schema concettuale (ER) in formato PNG.">
	</div>
    <div>
        <h2 class="text-gray-600 text-2xl lg:text-3xl  mt-4 lg:m-6">Implementazione fisica</h2>
        <a class="text-blue-600 font-extrabold" href="static/sql/dbinit.sql">Scarica il file SQL di inizializzazione del DB!</a>
    </div>
</div>