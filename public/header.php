<header class="w-full p-4 bg-sky-500/50 z-50 absolute top-0 right-0 flex justify-end">


<?php if ($profile_data): ?>
        <form action="logout.php" method="POST">
            <button type="submit" class="px-4 py-2  bg-red-500 text-white rounded hover:bg-red-700">Déconnexion</button>
        </form>
    <?php endif; ?>
</header>


<style>
header{
background: rgba(243, 244, 246, 0.11);
/* box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
 */backdrop-filter: blur(5px);
}


</style>