
<div class="container">
    <?php if (app()->session->hasFlash('success')): ?>
    <p class="has-text-success">
        <?= app()->session->getFlash('success'); ?>
    </p>
    <?php endif; ?>
    <h1>Login</h1>
    <form method="post" action="/login">
        
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" name="email" value="<?= old('email'); ?>">
            </div>
            <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['email'][0]; ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password">
            </div>
            <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['password'][0]; ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>
</div>
