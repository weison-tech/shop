<?php
/**
 * @var $this yii\web\View
 */
use store\assets\storeAsset;
use store\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$bundle = storeAsset::register($this);
?>
<?php $this->beginContent('@store/views/layouts/base.php'); ?>
    <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
        <header class="main-header">
            <a href="<?=Url::to(['/site/index'])?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo Yii::t('store','Store Admin') ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?php echo Yii::t('store', 'Toggle navigation') ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/images/default_avator.png" class="user-image">
                                <span><?php echo Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header light-blue">
                                    <img src="/images/default_avator.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo Yii::$app->user->identity->username ?>
                                        <small>
                                            <?php echo Yii::t('store', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) ?>
                                        </small>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!-- <div class="pull-left">
                                        <?php echo Html::a(Yii::t('store', 'Profile'), ['/sign-in/profile'], ['class'=>'btn btn-default btn-flat']) ?>
                                    </div>
                                    <div class="pull-left">
                                        <?php echo Html::a(Yii::t('store', 'Account'), ['/sign-in/account'], ['class'=>'btn btn-default btn-flat']) ?>
                                    </div> -->
                                    <div class="pull-right">
                                        <?php echo Html::a(Yii::t('store', 'Logout'), ['/user/logout'], ['class'=>'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <?php echo Html::a('<i class="fa fa-cogs"></i>', ['/site/settings'])?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/images/default_avator.png" class="img-circle" />
                    </div>
                    <div class="pull-left info">
                        <p><?php echo Yii::t('store', 'Hello, {username}', ['username'=>Yii::$app->user->identity->username]) ?></p>
                        <a>
                            <i class="fa fa-circle text-success"></i>
                            <?php echo Yii::$app->formatter->asDatetime(time()) ?>
                        </a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?php echo Menu::widget([
                    'options'=>['class'=>'sidebar-menu'],
                    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                    'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                    'activateParents'=>true,
                    'items'=>[
                        [
                            'label'=>Yii::t('store', 'Main'),
                            'options' => ['class' => 'header']
                        ],
                        [
                            'label'=>Yii::t('store', 'Dashboard'),
                            'icon'=>'<i class="fa fa-bar-chart-o"></i>',
                            'url'=>['/'],
                        ],
                        [
                            'label'=>Yii::t('store', 'Goods Management'),
                            'url' => '#',
                            'icon'=>'<i class="fa fa-bank"></i>',
                            'options'=>['class'=>'treeview'],
                            'items'=>[
                                ['label'=>Yii::t('store', 'Goods Management'), 'url'=>['/goods/goods/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                                ['label'=>Yii::t('store', 'Self Category Management'), 'url'=>['/goods/goods-category/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                            ]
                        ],

                        [
                            'label'=>Yii::t('store', 'System'),
                            'options' => ['class' => 'header']
                        ],
                        [
                            'label'=>Yii::t('store', 'Users'),
                            'icon'=>'<i class="fa fa-users"></i>',
                            'url'=>['/user/index'],
                            'visible'=>Yii::$app->user->can('administrator')
                        ],
                        [
                            'label'=>Yii::t('store', 'System Setting'),
                            'url' => '#',
                            'icon'=>'<i class="fa fa-cogs"></i>',
                            'options'=>['class'=>'treeview'],
                            'items'=>[
                                [
                                    'label'=>Yii::t('common', 'Language'),
                                    'items'=>array_map(function ($code) {
                                        return [
                                            'label' => Yii::$app->params['availableLocales'][$code],
                                            'url' => ['/site/set-locale', 'locale'=>$code],
                                            //'active' => Yii::$app->language === $code
                                        ];
                                    }, array_keys(Yii::$app->params['availableLocales'])),
                                    'url' => '#',
                                    'icon'=>'<i class="fa fa-flag"></i>',
                                    'options'=>['class'=>'treeview'],
                                ],
                            ]
                        ]
                    ]
                ]) ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $this->title ?>
                    <?php if (isset($this->params['subtitle'])): ?>
                        <small><?php echo $this->params['subtitle'] ?></small>
                    <?php endif; ?>
                </h1>

                <?php echo Breadcrumbs::widget([
                    'tag'=>'ol',
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php if (Yii::$app->session->hasFlash('alert')):?>
                    <?php echo \yii\bootstrap\Alert::widget([
                        'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                        'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                    ])?>
                <?php endif; ?>
                <?php echo $content ?>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

<?php $this->endContent(); ?>