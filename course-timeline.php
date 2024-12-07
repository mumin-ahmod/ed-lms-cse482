<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($_GET['success']); ?>
    </div>
<?php endif; ?>s