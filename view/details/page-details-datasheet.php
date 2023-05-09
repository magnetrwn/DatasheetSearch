<h2 class="flex flex-col items-center justify-center p-9 mx-auto my-2 text-3xl text-gray-900 font-extrabold">Dettagli associati al Datasheet</h2>
<p class="flex flex-col items-center justify-center mx-auto pt-12 text-gray-400 bg-gray-900">Oppure inserisci il nome di un altro documento!</p>
<div class="p-1 pb-10 text-gray-100 bg-gray-900">
    <?php include("view/search/page-search-bar.html"); ?>
</div>
<div class="p-10"></div>
<div class="container mx-auto px-4 py-8">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
      <h1 class="text-2xl font-bold mb-4">Nome Componente</h1>
      <p class="text-lg mb-4">Descrizione componente...</p>
      <div class="flex flex-wrap mb-4">
        <div class="w-full md:w-1/2 lg:w-1/3">
          <p class="text-gray-500 mb-2">Azienda produttrice:</p>
          <p>Azienda produttrice</p>
        </div>
        <div class="w-full md:w-1/2 lg:w-1/3">
          <p class="text-gray-500 mb-2">Famiglia:</p>
          <p>Famiglia</p>
        </div>
        <div class="w-full md:w-1/2 lg:w-1/3">
          <p class="text-gray-500 mb-2">Datasheet:</p>
          <a href="#" class="text-blue-500 hover:underline">Scarica Datasheet</a>
        </div>
      </div>
      <div class="border-t border-gray-300 py-4">
        <h2 class="text-lg font-medium mb-2">Specifiche tecniche</h2>
        <table class="w-full">
          <tbody>
            <tr>
              <td class="border-t border-gray-300 py-2 px-4 font-medium text-gray-500">Parameter 1:</td>
              <td class="border-t border-gray-300 py-2 px-4">Value 1</td>
            </tr>
            <tr>
              <td class="border-t border-gray-300 py-2 px-4 font-medium text-gray-500">Parameter 2:</td>
              <td class="border-t border-gray-300 py-2 px-4">Value 2</td>
            </tr>
            <tr>
              <td class="border-t border-gray-300 py-2 px-4 font-medium text-gray-500">Parameter 3:</td>
              <td class="border-t border-gray-300 py-2 px-4">Value 3</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div>
      <img src="#" alt="Immagine package" class="mb-4">
      <div class="border border-gray-300 rounded-md p-4">
        <h2 class="text-lg font-medium mb-2">Pricing and Availability</h2>
        <p class="text-gray-500 mb-4">Pricing information and availability status.</p>
        <a href="#" class="bg-blue-500 text-white rounded-md py-2 px-4 hover:bg-blue-600">Add to Cart</a>
      </div>
    </div>
  </div>
</div>
