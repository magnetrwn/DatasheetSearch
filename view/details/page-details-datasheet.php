<h2 class="flex flex-col items-center justify-center p-9 mx-auto my-2 text-3xl text-gray-900 font-extrabold">Dettagli associati al Datasheet</h2>
<p class="flex flex-col items-center justify-center mx-auto pt-12 text-gray-400 bg-gray-900">Oppure inserisci il nome di un altro documento!</p>
<div class="p-1 pb-10 text-gray-100 bg-gray-900">
    <?php include("view/search/page-search-bar.html"); ?>
</div>
<div class="p-10"></div>
<div class="mx-20 2xl:mx-60 px-4 py-8">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
      <h1 class="text-2xl font-bold mb-4"><?php echo $datasheetname; ?></h1>
      <p class="text-md mb-4"><?php echo $detaildata['cpdesc']; ?></p>
      <div class="flex flex-wrap mb-8">
        <div class="mt-8 text-sm w-full md:w-1/2 lg:w-1/3">
          <p class="text-gray-500 mb-1">Azienda produttrice:</p>
          <p class="text-lg"><?php echo $detaildata['aznome']; ?></p>
        </div>
        <div class="mt-8 text-sm w-full md:w-1/2 lg:w-1/3">
          <p class="text-gray-500 mb-1">Famiglia:</p>
          <p class="text-lg"><?php echo $detaildata['famiglia']; ?></p>
        </div>
        <div class="mt-8 text-sm w-full md:w-1/2 lg:w-1/3">
          <p class="text-gray-500 mb-1">Datasheet:</p>
          <a href="dynamic/ds/<?php echo $datasheetname.$datasheetversion; ?>.pdf" class="text-lg text-blue-500 hover:underline">Scarica Datasheet</a>
        </div>
      </div>
      <div class="border-t border-gray-300 py-4">
        <h2 class="text-lg font-medium mb-2">Informazioni</h2>
        <table class="w-full">
          <tbody>
            <tr>
              <td class="border-t border-gray-300 py-2 px-4 font-medium text-gray-500">Package disponibili:</td>
              <td class="border-t border-gray-300 py-2 px-4">...</td>
            </tr>
            <tr>
              <td class="border-t border-gray-300 py-2 px-4 font-medium text-gray-500">...</td>
              <td class="border-t border-gray-300 py-2 px-4">...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div>
      <img src="<?php echo $detaildata['icona']; ?>" alt="Immagine package" class="mb-4 w-48 h-48 2xl:w-72 2xl:h-72">
      <div class="rounded bg-gray-900 p-4 pb-6">
        <h2 class="text-lg text-white font-extrabold mb-2">Non ti piace il risultato?</h2>
        <p class="text-gray-400 mb-4">Prova ad usare un altro motore di ricerca.</p>
        <a href="https://datasheetspdf.com/datasheet/search.php?sWord=<?php echo $datasheetname; ?>" class="px-5 py-2 rounded bg-violet-400 text-gray-900">Cercalo su DatasheetsPDF</a>
      </div>
    </div>
  </div>
</div>
