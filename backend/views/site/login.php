<?php

/* @var $this View */
/* @var $form ActiveForm */

/* @var $model LoginForm */

use common\models\LoginForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>

<div class="login">
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <h1><h1><?= Html::encode($this->title) ?></h1></h1>
                <div>
                    <?= $form->field($model, 'username')->textInput([
                        'placeholder' => $model->getAttributeLabel('username')
                    ])->label(false) ?>
                </div>
                <div>
                    <?= $form->field($model, 'password')->passwordInput([
                        'placeholder' => $model->getAttributeLabel('password')
                    ])->label(false) ?>
                </div>
                <div>
                    <?= Html::submitButton('Log in', ['class' => 'btn btn-secondary submit', 'name' => 'login-button']) ?>
                    <a class="reset_pass" href="#">Lost your password?</a>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                    <p class="change_link">New to site?
                        <a href="#signup" class="to_register"> Create Account </a>
                    </p>
                    <div class="clearfix"></div>
                    <br>
                    <div>
                        <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </section>
        </div>
        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="">
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>
                        <div class="clearfix"></div>
                        <br>
                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and
                                Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
