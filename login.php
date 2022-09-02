<?php
require_once "./includes/header.php";
require_once "./src/UserModel.php";
$userModel = new UserModel();
$error = $userModel->loginUser();

if (getLoggedUser())
{
  header("Location: index.php");
  exit;
}
?>

<form method="post" class="w-1/2 mx-auto bg-white border rounded p-4 shadow-md">
  <h1 class="text-6xl font-light text-center mb-10 uppercase">Se connecter</h1>

  <?php if(isset($error)): ?>
    <p class="text-red-400 text-center"><?= $error ?></p>
  <?php endif ?>

  <div class="mb-4">
    <label class="block mb-2" for="email">Mon email:</label>
    <input class="border rounded border-gray-100 py-2 px-4 w-full outline-none shadow-sm" type="email" name="email" id="email">
  </div>

  <div class="mb-4">
    <label class="block mb-2" for="password">Mon mot de passe:</label>
    <input class="border rounded border-gray-100 py-2 px-4 w-full outline-none shadow-sm" type="password" name="password" id="password">
  </div>

  <button class="w-full rounded p-4 bg-green-500 hover:bg-green-700 text-white font-semibold">
  <i class="fa-solid fa-paper-plane mr-2"></i>Envoyer
  </button>
</form>

<?php require_once "./includes/footer.php" ?>