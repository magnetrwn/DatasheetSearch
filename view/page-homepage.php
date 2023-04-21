<div class="container flex flex-col items-center justify-center p-11 mx-auto my-2 text-3xl text-gray-100 bg-gray-900 font-extrabold">
    <?php echo $welcome; ?>
</div>
<div class="grid gap-4 grid-cols-2 text-gray-600 m-4 lg:m-12">
	<div>
		<h2 class="text-gray-600 my-4 lg:my-12 text-2xl lg:text-3xl">Documentazione</h2>
        <iframe width="480" height="600" src="static/document/riferimento.pdf"></iframe>
	</div>
    <div>
		<h2 class="text-gray-600 my-4 lg:my-12 text-2xl lg:text-3xl">Schema concettuale</h2>
        <img class="object-contain mt-8 mr-8" src="static/img/er.png" alt="Schema concettuale (ER) in formato PNG.">
	</div>
    <div>
        <h2 class="text-gray-600 text-2xl lg:text-3xl  mt-4 lg:mt-12">Implementazione fisica</h2>
        <a class="text-red-600" href="static/sql/dbinit.sql">Scarica il file SQL di inizializzazione del DB!</a>
    </div>
</div>