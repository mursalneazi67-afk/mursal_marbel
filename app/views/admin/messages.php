<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h3 font-heading fw-bold mb-1">Customer Inquiries Inbox</h2>
        <p class="text-muted small mb-0">Review project quote requests and client feedback.</p>
    </div>
</div>

<div class="card border-0 rounded-4 shadow-sm p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Sender Name</th>
                    <th>Contact Info</th>
                    <th>Subject</th>
                    <th>Message Snippet</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $msg): ?>
                        <tr class="<?= $msg['status'] === 'unread' ? 'table-warning fw-semibold' : '' ?>">
                            <td class="small text-muted"><?= date('Y-m-d H:i', strtotime($msg['created_at'])) ?></td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($msg['name']) ?></td>
                            <td class="small">
                                <div><i class="bi bi-envelope text-gold me-1"></i><?= htmlspecialchars($msg['email']) ?></div>
                                <?php if (!empty($msg['phone'])): ?>
                                    <div><i class="bi bi-telephone text-gold me-1"></i><?= htmlspecialchars($msg['phone']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="text-gold fw-bold"><?= htmlspecialchars($msg['subject']) ?></td>
                            <td><small class="text-muted"><?= htmlspecialchars(substr($msg['message'], 0, 80)) ?>...</small></td>
                            <td>
                                <?php if ($msg['status'] === 'unread'): ?>
                                    <span class="badge bg-danger">Unread</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Read</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-dark rounded-pill me-1" data-bs-toggle="modal" data-bs-target="#msgModal<?= $msg['id'] ?>">
                                    <i class="bi bi-eye"></i> View
                                </button>
                                <?php if ($msg['status'] === 'unread'): ?>
                                    <a href="<?= URLROOT ?>/admin/messages/read/<?= $msg['id'] ?>" class="btn btn-sm btn-outline-success rounded-pill me-1">
                                        <i class="bi bi-check2-all"></i> Mark Read
                                    </a>
                                <?php endif; ?>
                                <form action="<?= URLROOT ?>/admin/messages/delete/<?= $msg['id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Delete this inquiry message?');">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- View Message Modal -->
                        <div class="modal fade" id="msgModal<?= $msg['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header bg-dark text-light">
                                        <h5 class="modal-title font-heading">Inquiry Details: <?= htmlspecialchars($msg['subject']) ?></h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block">From:</small>
                                                <strong><?= htmlspecialchars($msg['name']) ?></strong> (&lt;<?= htmlspecialchars($msg['email']) ?>&gt;)
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block">Phone:</small>
                                                <strong><?= htmlspecialchars($msg['phone'] ?: 'N/A') ?></strong>
                                            </div>
                                            <div class="col-12">
                                                <small class="text-muted d-block">Date Received:</small>
                                                <span><?= htmlspecialchars($msg['created_at']) ?></span>
                                            </div>
                                        </div>

                                        <hr>

                                        <h6 class="fw-bold mb-2">Message Body:</h6>
                                        <div class="p-3 bg-light rounded-3 border text-dark">
                                            <?= nl2br(htmlspecialchars($msg['message'])) ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <a href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=Re: <?= urlencode($msg['subject']) ?>" class="btn btn-gold rounded-pill px-4">
                                            <i class="bi bi-reply-fill me-1"></i> Reply via Email
                                        </a>
                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No inquiry messages in inbox.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</div>
</div>
