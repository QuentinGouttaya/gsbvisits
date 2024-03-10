<?php if (!empty($medicaments)): ?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Composition</th>
        <th>Effects</th>
        <th>Contraindication</th>
        <th>Family</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($medicaments as $medicament): ?>
    <tr>
        <td><?php echo $medicament['id']; ?></td>
        <td><?php echo $medicament['name']; ?></td>
        <td><?php echo $medicament['composition']; ?></td>
        <td><?php echo $medicament['effects']; ?></td>
        <td><?php echo $medicament['contraindication']; ?></td>
        <td><?php echo $medicament['family']; ?></td>
        <td>
            <a href="/medicaments/edit/<?php echo $medicament['id']; ?>">Edit</a> |
            <a href="/medicaments/delete/<?php echo $medicament['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No medicaments found.</p>
<?php endif; ?>
<a href="/medicaments/create">Add New Medicament</a>
