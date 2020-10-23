<?php

use modava\log\LogModule;
use modava\log\widgets\NavbarWidgets;
use yii\helpers\Html;
use common\grid\MyGridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modava\log\models\search\Voip24hLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Voip24h Log');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="container-fluid px-xxl-25 px-xl-10">
        <?= NavbarWidgets::widget(); ?>

        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                            class="ion ion-md-apps"></span></span><?= Html::encode($this->title) ?>
            </h4>
        </div>

        <?= $this->render('_search', [
            'model' => $searchModel
        ]) ?>

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper index">

                    <?php Pjax::begin(['id' => 'voip-log-pjax', 'timeout' => false, 'enablePushState' => true, 'clientOptions' => ['method' => 'GET']]); ?>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="dataTables_wrapper dt-bootstrap4">
                                    <?= MyGridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'layout' => '
                                            {errors}
                                            <div class="pane-single-table">
                                                {items}
                                            </div>
                                            <div class="pager-wrap clearfix">
                                                <div class="summary pull-right">
                                                    Tổng ' . $searchModel->total . '
                                                </div>
                                                <ul class="pagination">
                                                    ' . $searchModel->getPrevPage() . $searchModel->getNextPage() . '
                                                </ul>
                                            </div>
                                        ',
                                        'tableOptions' => [
                                            'id' => 'dataTable',
                                            'class' => 'dt-grid dt-widget pane-hScroll',
                                        ],
                                        'myOptions' => [
                                            'class' => 'dt-grid-content my-content pane-vScroll',
                                            'data-minus' => '{"0":105,"1":".hk-navbar","2":".nav-tabs","3":".hk-pg-header","4":".hk-footer-wrap","5":".voip-log-fsearch"}'
                                        ],
                                        'pager' => [
                                            'firstPageLabel' => Yii::t('backend', 'First'),
                                            'lastPageLabel' => Yii::t('backend', 'Last'),
                                            'prevPageLabel' => Yii::t('backend', 'Previous'),
                                            'nextPageLabel' => Yii::t('backend', 'Next'),
                                            'maxButtonCount' => 5,

                                            'options' => ['tag' => 'ul',
                                                'class' => 'pagination',],

                                            // Customzing CSS class for pager link
                                            'linkOptions' => ['class' => 'page-link'],
                                            'activePageCssClass' => 'active',
                                            'disabledPageCssClass' => 'disabled page-disabled',
                                            'pageCssClass' => 'page-item',

                                            // Customzing CSS class for navigating link
                                            'prevPageCssClass' => 'paginate_button page-item prev',
                                            'nextPageCssClass' => 'paginate_button page-item next',
                                            'firstPageCssClass' => 'paginate_button page-item first',
                                            'lastPageCssClass' => 'paginate_button page-item last',
                                        ],
                                        'columns' => [
                                            [
                                                'class' => 'yii\grid\SerialColumn',
                                                'header' => 'STT',
                                                'headerOptions' => [
                                                    'width' => 60,
                                                    'rowspan' => 2
                                                ],
                                                'filterOptions' => [
                                                    'class' => 'd-none',
                                                ],
                                            ],
                                            [
                                                'attribute' => 'calldate',
                                                'headerOptions' => ['width' => 200]
                                            ],
                                            [
                                                'attribute' => 'recording',
                                                'format' => 'raw',
                                                'value' => function ($model) {
                                                    if (!isset($model->recording) || $model->recording == '') return null;
                                                    return '<button type="button" class="btn btn-sm btn-primary" data-url="'. $model->recording .'"  data-toggle="modal" data-target="#recordAudio"><i class="fa fa-play-circle"></i></button>';
                                                }
                                            ],

                                            [
                                                'attribute' => 'src',
                                                'label' => Yii::t('backend', 'From'),
                                                'headerOptions' => ['width' => 120]
                                            ],
                                            [
                                                'attribute' => 'dst',
                                                'label' => Yii::t('backend', 'To'),
                                                'value' => function ($model) {
                                                    return $model->dst;
                                                },
                                                'headerOptions' => ['width' => 120]
                                            ],
                                            [
                                                'attribute' => 'status',
                                                'label' => Yii::t('backend', 'Status'),
                                                'headerOptions' => ['width' => 150]
                                            ],
                                            [
                                                'attribute' => 'billsec',
                                                'value' => function ($model) {
                                                    if ($model->billsec == 0) return null;
                                                    return gmdate("H:i:s", $model->billsec);
                                                },
                                                'label' => Yii::t('backend', 'Time'),
                                                'headerOptions' => ['width' => 150]
                                            ],
                                        ]
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php Pjax::end(); ?>
                </section>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="recordAudio" tabindex="-1" role="dialog" aria-labelledby="recordAudio" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recordAudioTitle">Recording</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
<?php
$urlChangePageSize = \yii\helpers\Url::toRoute(['perpage']);
$script = <<< JS
var customPjax = new myGridView();
customPjax.init({
    pjaxId: '#voip-log-pjax',
    urlChangePageSize: '$urlChangePageSize',
});
$('body').on('click', '.pagination .page-link', function(e){
    e.preventDefault();
    var start = $(this).attr('data-start') || null;
    console.log(start);
    if(start != null){
        $('#voip24h-log-start').val(start);
        $('#search-log').trigger('click');
    }
    return false;
});

$('#recordAudio').on('show.bs.modal', function (event) {
    $(this).find('.modal-body').html(''); // refresh body
}).on('shown.bs.modal', function (event) {
     var modal = $(this)
      var button = $(event.relatedTarget)
      var url = button.data('url')
      modal.find('.modal-body').html('<audio controls autoplay><source src="'+ url +'"></audio>');
}).on('hide.bs.modal', function () {
    $(this).find('.modal-body').html(''); // refresh body
});
JS;
$this->registerJs($script, \yii\web\View::POS_END);