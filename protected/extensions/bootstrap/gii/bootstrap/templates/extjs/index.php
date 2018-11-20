<?php
echo '
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/'.$this->modelClass.'/model.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/'.$this->modelClass.'/_form.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app/'.$this->modelClass.'/main.js"></script>';