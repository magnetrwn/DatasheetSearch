<section class="flex items-center h-full py-24 bg-gray-900 text-gray-100">
	<div class="flex flex-col items-center justify-center px-5 mx-auto my-8">
		<div class="max-w-xl text-center">
			<h2 class="mb-4 font-extrabold text-2xl text-gray-400">
				<?php 
					if(isset($_GET["msg"]))
						switch($_GET["msg"]) {
							case "register":
								echo "Registrazione effettuata!";
								break;
							default:
								echo "Operazione riuscita!";
								break;
						}
				?>
			</h2>
			<p class="mt-4 mb-14 text-gray-400">
				<?php 
					if(isset($_GET["msg"]))
						switch($_GET["msg"]) {
							case "register":
								echo "Ora puoi proseguire con la pagina di login.";
								break;
							default:
								echo "Ora puoi continuare la tua giornata serenamente.";
								break;
						}
				?>
			</p>
			<a href="index.php?goto=<?php 
				if(isset($_GET["btngoto"]))
					echo $_GET["btngoto"];
				else
					echo "homepage";
			?>" class="px-8 py-3 font-semibold rounded bg-violet-400 text-gray-900">Continua</a>
		</div>
	</div>
</section>