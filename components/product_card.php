<div id="cards" class="bg-white flex justify-between items-center shadow-sm mb-6 p-6">
    <img class="w-36" src="<?= $plant->getImage() ?>" alt="">
    <div class="w-2/3">
        <h2 class="text-4xl uppercase">
            <?= $plant->getName() ?>
        </h2>
        <h4 class="text-2xl font-light text-red-400">
            <?= $plant->getPrice() ?> €
        </h4>
    </div>
    <a href="details.php?id=<?= $plant->getId() ?>" class="py-2 px-4 rounded bg-green-500 hover:bg-green-700 text-white">
        <i class="fa-solid fa-eye mr-2"></i>Voir plus
    </a>
</div>