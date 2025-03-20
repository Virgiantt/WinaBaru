<style>
	.bg-new {
		background: rgb(0,17,87);
		background: linear-gradient(29deg, rgba(0,17,87,1) 0%, rgba(2,175,209,1) 95%, rgba(0,209,255,1) 100%);
	}
	.btn-new {
		background-color: #070074;
	}
</style>
<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
		<div class="row">
			<div class="col">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						Total Jumlah Pelanggan
					</div>
					<div class="card-body">
						<?php if(!empty($online_users)): ?>
							<ul class="list-group">
								<?php foreach($online_users as $user): ?>
									<li class="list-group-item">
										<strong><?php echo htmlspecialchars($user['nama']); ?></strong> 
										(<?php echo htmlspecialchars($user['username']); ?>)
									</li>
								<?php endforeach; ?>
							</ul>
						<?php else: ?>
							<p>No users are currently online.</p>
						<?php endif; ?>
					</div>
					<div class="card-footer">
						Test
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						Total Jumlah Pelanggan
					</div>
					<div class="card-body">
						Test
					</div>
					<div class="card-footer">
						Test
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card shadow">
					<div class="card-header bg-new text-white">
						Total Jumlah Pelanggan
					</div>
					<div class="card-body">
						Test
					</div>
					<div class="card-footer">
						Test
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="col">
			<div class="card shadow">
				<div class="card-header bg-new text-white">
					Total Jumlah Pelanggan
				</div>
				<div class="card-body">
					Test
				</div>
				<div class="card-footer">
					Test
				</div>
			</div>
		</div>
	</div>
</main>