<div id="mainContainer" class="profile clearfix" data-plugins="main">
	<div class="setting-content" role="content">
		<div class="setting-main" role="main">

			<div class="clearfix pam">
				<div class="span12">
					<div class="setting-title">
						<i class="icon-users mrm"></i><?=$this->item['sale_fullname']?>
					</div>
					<div class="rfloat mrm">
						<span class="gbtn">
						<a class="btn btn-no-padding btn-orange" data-plugins="dialog" href="<?=URL?>sales/edit/<?=$this->item['id']?>?next=<?=URL?>customers"><i class="icon-pencil"></i></a>
					</span>
					<span class="gbtn">
						<a class="btn btn-no-padding btn-red" data-plugins="dialog" href="<?=URL?>sales/del/<?=$this->item['id']?>?next=<?=URL?>customers"><i class="icon-trash"></i></a>
					</span>
					</div>
				</div>
			</div>

			<div class="clearfix">
				<div class="span12">
					<div class="uiBoxOverlay pam pas">
						<h3 class="mbm fwb"><i class="icon-user"></i> ข้อมูลพนักงานขาย</h3>
						<ul>
							<li>
								<label><span class="fwb">รหัส : </span><?=$this->item['sale_code']?></label>
							</li>
							<li>
								<label><span class="fwb">ชื่อ : </span><?=$this->item['sale_fullname']?> (<?=$this->item['sale_name']?>)</label>
							</li>
							<li>
								<label><span class="fwb">Username : </span><?=$this->item['username']?></label>
							</li>
							<li>
								<label><span class="fwb">ภูมิภาค : </span><?=( !empty($this->item['region_arr']['name']) ? $this->item['region_arr']['name'] : "-" )?></label>
							</li>
							<li>
								<label><span class="fwb">Status : </span><?=(!empty($this->item['status_arr']['name']) ? $this->item['status_arr']['name'] : "-")?></label>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="clearfix">
				<div class="span12">
					<div class="uiBoxOverlay mtm pam pas">
						<div ref="table" class="listpage2-table">
							<table class="table-bordered">
								<thead>
									<tr>
										<th class="ID">ลำดับ</th>
										<th class="date">วันที่</th>
										<th class="ID">ORDER CODE</th>
										<th class="name">ชื่อร้าน</th>
										<th class="price">ยอดรวม</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$num = 0;
									$total_price = 0;
									if ( !empty($this->orders['lists']) ) {
										foreach ($this->orders['lists'] as $key => $value) {
											$num++;
											$total_price += $value['net_price'];
											?>
											<tr>
												<td class="ID"><?=$num?></td>
												<td class="date"><?= date('d/m/Y', strtotime($value['date'])) ?></td>
												<td class="ID"><?=$value['code']?></td>
												<td class="name">
													<span class="fwb">
														<a href="<?=URL?>customers/<?=$value['id']?>" target="_blank"><?=$value['user_name']?></a>
													</span>
												</td>
												<td class="price"><?=number_format($value['net_price'],2)?></td>
											</tr>
											<?php
										}
									}else{
										echo '<td colspan="3" style="text-align:center; color:red;" class="fwb">ไม่พบข้อมูลการซื้อสินค้า</td>';
									}
									?>
								</tbody>
								<tfoot>
									<th colspan="4" style="text-align: right;" class="fwb">รวม</th>
									<th class="fwb" style="text-align: center;"><?=number_format($total_price, 2)?></th>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
