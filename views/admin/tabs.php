<?php
$isEditing = is_array($editingTab);
$formAction = $isEditing ? admin_url('resource=tabs&action=edit&id=' . (int) $editingTab['id']) : admin_url('resource=tabs&action=create');
?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card">
            <h1 class="h5 mb-3"><?= $isEditing ? 'Edit Tab' : 'Create Tab' ?></h1>
            <form method="post" action="<?= e($formAction) ?>" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <input class="form-control" id="title" name="title" required value="<?= e($editingTab['title'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="sort_order">Sort Order</label>
                    <input class="form-control" id="sort_order" type="number" name="sort_order" value="<?= e((string) ($editingTab['sort_order'] ?? 0)) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="icon">Icon</label>
                    <input class="form-control" id="icon" type="file" name="icon" accept="image/*">
                    <?php if (!empty($editingTab['icon'])): ?>
                        <img class="preview-icon mt-2" src="../<?= e($editingTab['icon']) ?>" alt="">
                    <?php endif; ?>
                </div>
                <button class="btn btn-primary w-100" type="submit"><?= $isEditing ? 'Update Tab' : 'Create Tab' ?></button>
                <?php if ($isEditing): ?>
                    <a class="btn btn-link w-100 mt-2" href="<?= e(admin_url('resource=tabs')) ?>">Cancel</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Order</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tabs as $tab): ?>
                        <tr>
                            <td>
                                <?php if (!empty($tab['icon'])): ?>
                                    <img class="preview-icon" src="../<?= e($tab['icon']) ?>" alt="">
                                <?php endif; ?>
                            </td>
                            <td><?= e($tab['title']) ?></td>
                            <td><?= e((string) $tab['sort_order']) ?></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="<?= e(admin_url('resource=tabs&action=edit&id=' . (int) $tab['id'])) ?>">Edit</a>
                                <form class="d-inline" method="post" action="<?= e(admin_url('resource=tabs&action=delete&id=' . (int) $tab['id'])) ?>" onsubmit="return confirm('Delete this tab and its slides?')">
                                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
