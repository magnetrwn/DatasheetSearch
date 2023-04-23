<div class="container flex flex-col items-center justify-center p-9 mx-auto my-2 text-3xl text-gray-900 font-extrabold">Registrazione</div>
<div class="container flex items-center justify-center mx-auto">
  <form class="flex grow shrink-0 lg:px-60 px-8 pt-24 pb-20 bg-gray-900 text-gray-100" action="index.php?goto=auth&newuser" method="post">
    <div class="m-6">
      <label class="block text-gray-100 font-bold mb-2" for="username">
        Username
      </label>
      <input
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"
        id="username"
        name="username"
        type="text"
        placeholder="Enter username"
        onkeyup="userExists(this.value)"
      >
      <div id="usercheck" class="rounded text-center px-6 py-3 mt-3 align-baseline font-bold text-sm text-2xl">
        ...
      </div>
    </div>
    <div class="m-6">
      <label class="block text-gray-100 font-bold mb-2" for="email">
        Email
      </label>
      <input
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"
        id="email"
        name="email"
        type="text"
        placeholder="Enter email"
        onkeyup="mailValid(this.value)"
      >
      <div id="mailcheck" class="rounded text-center px-6 py-3 mt-3 align-baseline font-bold text-sm text-2xl">
        ...
      </div>
    </div>
    <div class="m-6">
      <label class="block text-gray-100 font-bold mb-2" for="password">
        Password
      </label>
      <input
        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"
        id="password"
        name="password"
        type="password"
        placeholder="Enter password"
        onkeyup="passwordValid(this.value)"
      >
      <div id="pwdcheck" class="rounded text-center px-6 py-3 mt-3 align-baseline font-bold text-sm text-2xl">
        ...
      </div>
    </div>
    <div class="m-6 mt-12">
      <button
        class="px-8 py-3 font-semibold rounded bg-violet-400 text-gray-900"
        id="register"
        type="submit"
      >
        Register
      </button>
    </div>
  </form>
</div>
<div class="<?php if(!isset($_GET["badregister"])) echo 'hidden'; ?> bg-gray-900 container flex flex-col items-center justify-center mx-auto pb-4">
  <div class="inline-block bg-red-900 rounded px-6 py-3 align-baseline font-bold text-sm text-2xl text-red-400">
    Register fallito, riprova.
  </div>
</div>
<script>
  <?php 
    include("view/auth/util-valid-interactive.js");
    include("view/ajax/request-ajax-exists.js"); 
  ?>
  disableAllNext("usercheck")
</script>