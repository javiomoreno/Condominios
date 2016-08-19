<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../adminlte/dist/img/avatar-none.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= app\models\Usuarios::findIdentity(\Yii::$app->user->getId())->nombre;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menú', 'options' => ['class' => 'header']],
                    ['label' => 'Apartamentos', 'icon' => 'fa fa-home', 'url' => ['/apartamentos/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
