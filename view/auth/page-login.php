<h2 class="flex flex-col items-center justify-center p-9 mx-auto my-2 text-3xl text-gray-900 font-extrabold">Procedi con il Login</h2>
<!--form class="flex lg:px-60 px-8 pt-24 pb-28 mb-4 bg-gray-900 text-gray-100" action="index.php?goto=auth" method="post"-->
<form class="flex flex-col items-center px-8 py-12 mb-4 bg-gray-900 text-gray-100" action="index.php?goto=auth" method="post">
  <div class="m-6">
    <label class="block text-gray-100 font-bold mb-2" for="username">
      Username
    </label>
    <input
      class="appearance-none border rounded w-full py-2 px-3 bg-gray-700 border-gray-600 placeholder-gray-400 leading-tight"
      id="username"
      name="username"
      type="text"
      placeholder="Enter username"
    >
  </div>
  <div class="m-6">
    <label class="block text-gray-100 font-bold mb-2" for="password">
      Password
    </label>
    <input
      class="appearance-none border rounded w-full py-2 px-3 bg-gray-700 border-gray-600 placeholder-gray-400 leading-tight"
      id="password"
      name="password"
      type="password"
      placeholder="Enter password"
    >
  </div>
  <div class="m-6 mt-12">
    <button
      class="px-8 py-3 font-semibold rounded bg-violet-400 text-gray-900"
      type="submit"
    >
      Login
    </button>
  </div>
  <div class="<?php if(!isset($_GET["badlogin"])) echo 'hidden'; ?> inline-block bg-red-900 rounded px-6 py-3 align-baseline font-bold text-sm text-2xl text-red-400">
      Login fallito, riprova.
  </div>
</form>