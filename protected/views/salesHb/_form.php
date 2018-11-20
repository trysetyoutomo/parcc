<?php
/* @var $this SalesHbController */
/* @var $model SalesHb */
/* @var $form CActiveForm */
?>

<div class="mws-panel grid_8">

    <div class="mws-panel-header">

        <span><i class="icon-pencil"></i> Text Inputs</span>

    </div>

    <div class="mws-panel-body no-padding">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales-hb-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
                'class' => 'mws-form',
            )
)); ?>
        <div class="mws-form-inline">

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

                            <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'date'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'date'); ?>
                    </div>
                    <?php echo $form->error($model,'date'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'customer_id'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'customer_id'); ?>
                    </div>
                    <?php echo $form->error($model,'customer_id'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'sale_sub_total'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'sale_sub_total'); ?>
                    </div>
                    <?php echo $form->error($model,'sale_sub_total'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'sale_discount'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'sale_discount'); ?>
                    </div>
                    <?php echo $form->error($model,'sale_discount'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'sale_service'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'sale_service'); ?>
                    </div>
                    <?php echo $form->error($model,'sale_service'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'sale_tax'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'sale_tax'); ?>
                    </div>
                    <?php echo $form->error($model,'sale_tax'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'sale_total_cost'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'sale_total_cost'); ?>
                    </div>
                    <?php echo $form->error($model,'sale_total_cost'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'sale_payment'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'sale_payment'); ?>
                    </div>
                    <?php echo $form->error($model,'sale_payment'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'paidwith_id'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'paidwith_id'); ?>
                    </div>
                    <?php echo $form->error($model,'paidwith_id'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'total_items'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'total_items'); ?>
                    </div>
                    <?php echo $form->error($model,'total_items'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'branch'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'branch'); ?>
                    </div>
                    <?php echo $form->error($model,'branch'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'user_id'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'user_id'); ?>
                    </div>
                    <?php echo $form->error($model,'user_id'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'table'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'table'); ?>
                    </div>
                    <?php echo $form->error($model,'table'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'comment'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>200)); ?>
                    </div>
                    <?php echo $form->error($model,'comment'); ?>

                </div>
                                <div class="mws-form-row">
                    <?php echo $form->labelEx($model,'status'); ?>
                    <div class="mws-form-item">
                        <?php echo $form->textField($model,'status'); ?>
                    </div>
                    <?php echo $form->error($model,'status'); ?>

                </div>
                


            <!-- form -->
        </div>
        <div class="mws-button-row">
            <input type="submit" value="Create" class="btn btn-danger">
            <input type="reset" value="Reset" class="btn ">
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>