<?php if (isset($visitor) && !empty($visitor)): ?>
    <h1>Welcome back, <?php echo htmlspecialchars($visitor->getSurname()); ?>!</h1>
    <p>Your name is <?php echo htmlspecialchars($visitor->getName()); ?>.</p>
    <p><a href="/auth/logout">Log out</a></p>
    <p><a href="/reports">View Reports</a></p>
    <p><a href="/medicaments">View Medicaments</a></p>
    <p><a href="/Report/create">Create Report</a></p> <!-- Add this line to create a "View Reports" button -->
<?php endif; ?>
