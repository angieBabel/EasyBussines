<div>
    <?php if (@$user_profile):
    ?>
    <h1>Bienvenido a mi aplicación</h1>
    <h2>Tu perfil aquí</h2>
    <div>
        <div>
            <?php foreach($user_profile as $descripcion => $dato)
            {
            ?>
            <?=$descripcion?>:    <strong><?=$dato?></strong><br />
            <?php
            }
            ?>
        </div>
    </div>
        <?php
        foreach($usuario as $fila)
        {
        ?>
            <?=$fila['email']?><br />
            <?=$fila['name']?>
        <?php
        }
        ?>
    <div><a href="<?=$logout_url?>">Salir</a></div>

    <?php else: ?>

    <a href="<?=@$login_url?>">Inicia es este?</a>
    <?php endif;?>
</div>
