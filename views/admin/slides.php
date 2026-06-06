<?php
$isEditing = is_array($editingSlide);
$formAction = $isEditing ? admin_url('resource=slides&action=edit&id=' . (int) $editingSlide['id']) : admin_url('resource=slides&action=create');
?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card">
            <h1 class="h5 mb-3"><?= $isEditing ? 'Edit Slide' : 'Create Slide' ?></h1>
            <form method="post" action="<?= e($formAction) ?>" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <div class="mb-3">
                    <label class="form-label" for="tab_id">Tab</label>
                    <select class="form-select" id="tab_id" name="tab_id" required>
                        <option value="">Select tab</option>
                        <?php foreach ($tabs as $tab): ?>
                            <option value="<?= (int) $tab['id'] ?>" <?= (int) ($editingSlide['tab_id'] ?? 0) === (int) $tab['id'] ? 'selected' : '' ?>>
                                <?= e($tab['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tag">Tag</label>
                    <input class="form-control" id="tag" name="tag" required value="<?= e($editingSlide['tag'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <textarea class="form-control" id="title" name="title" rows="3" required><?= e($editingSlide['title'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="learn_more_link">Learn More Link</label>
                    <input class="form-control" id="learn_more_link" name="learn_more_link" value="<?= e($editingSlide['learn_more_link'] ?? '#') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="sort_order">Sort Order</label>
                    <input class="form-control" id="sort_order" type="number" name="sort_order" value="<?= e((string) ($editingSlide['sort_order'] ?? 0)) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input class="form-control" id="image" type="file" name="image" accept="image/*" <?= $isEditing ? '' : 'required' ?>>
                    <?php if (!empty($editingSlide['image'])): ?>
                        <img class="preview-slide mt-2" src="../<?= e($editingSlide['image']) ?>" alt="">
                    <?php endif; ?>
                </div>
                <button class="btn btn-primary w-100" type="submit"><?= $isEditing ? 'Update Slide' : 'Create Slide' ?></button>
                <?php if ($isEditing): ?>
                    <a class="btn btn-link w-100 mt-2" href="<?= e(admin_url('resource=slides')) ?>">Cancel</a>
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
                        <th>Image</th>
                        <th>Slide</th>
                        <th>Tab</th>
                        <th>Order</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($slides as $slide): ?>
                        <tr>
                            <td><img class="preview-slide" src="../<?= e($slide['image']) ?>" alt=""></td>
                            <td>
                                <span class="badge text-bg-info mb-1"><?= e($slide['tag']) ?></span>
                                <div><?= e($slide['title']) ?></div>
                            </td>
                            <td><?= e($slide['tab_title']) ?></td>
                            <td><?= e((string) $slide['sort_order']) ?></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="<?= e(admin_url('resource=slides&action=edit&id=' . (int) $slide['id'])) ?>">Edit</a>
                                <form class="d-inline" method="post" action="<?= e(admin_url('resource=slides&action=delete&id=' . (int) $slide['id'])) ?>" onsubmit="return confirm('Delete this slide?')">
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
