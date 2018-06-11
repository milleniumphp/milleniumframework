<h2>Login</h2>
<?if($session->alert):?>
<div class="alert alert-danger">
    <? echo $session->alert['login']?>
</div>
<?endif;?>
<div class="row">
    <div class="col-md-6">
        <!--Create new form-->
        <? $form = mill\html\Form::create(['method' => 'post', 'action' => 'real']) ?>
        <!--First form field with options-->
            <div class="form-group">
                <?=$form->field($user, 'login', [
                    'label' => 'User Login',
                    'class' => 'form-control user',
                    'name' => 'login'
                ])?>
            </div>
        <!--second form field-->
            <div class="form-group">
                <?=$form->field($user, 'password',[
                    'type' => 'password',
                    'name' => 'password'
                ])?>
            </div>
        <!--success button almost with params-->
            <div class="form-group">
                <?= $form->submit(
                    ['class' => 'btn btn-success'
                ]) ?>
            </div>
        <!--End Form tag-->
        <? $form->end() ?>    
        
    </div>
</div>
<?unset($session->alert)?>