<div id="mainContainer" class="profile clearfix" data-plugins="main">
	<div class="setting-content" role="content">
		<div class="setting-main" role="main">

			<div class="clearfix pam">
				<div class="span12">
					<div class="setting-title">
						<i class="icon-users mrm"></i><?=$this->item['name_store']?>
					</div>
					<div class="rfloat mrm">
						<a class="btn btn-no-padding btn-red" data-plugins="dialog" href="<?=URL?>customers/del/<?=$this->item['id']?>?next=<?=URL?>customers"><i class="icon-trash"></i></a>
					</div>
				</div>
			</div>

			<div class="clearfix">
				<div class="span12">
					<div class="uiBoxOverlay pam pas">
						<h3 class="mbm fwb"><i class="icon-user"></i> Customer data</h3>
						<ul>
							<li>
								<label><span class="fwb">Store name : </span><?=$this->item['name_store']?></label>
							</li>
							<li>
								<label><span class="fwb">Code : </span><?=$this->item['sub_code']?></label>
							</li>
							<?php
							$num=1;
							foreach ($this->item['address'] as $key => $value) {

								$address = '';
								if( !empty($value['address']) ){
									$address .= $value['address'];
								}
								if( !empty($value['road']) ){
									$address .= ' <span class="fwb">Road</span> '.$value['road'];
								}
								if( !empty($value['district']) ){
									$address .= ' <span class="fwb">District</span> '.$value['district'];
								}
								if( !empty($value['area']) ){
									$address .= ' <span class="fwb">Area</span> '.$value['area'];
								}
								if( !empty($value['province']) ){
									$address .= ' <span class="fwb">Province</span> '.$value['province'];
								}
								if( !empty($value['post_code']) ){
									$address .= ' '.$value['post_code'];
								}
								if( !empty($value['country_name']) ){
									$address .= ' <span class="fwb">'.$value['country_name'].'</span>';
								}

								echo '<li>
										<label>
											<span class="fwb">(Address '.$num.')</span> '.$address.'
										</label>
									 </li>';
								$num++;
							}
							?>
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
										<th class="ID">Order</th>
										<th class="name">ORDER CODE</th>
										<th class="price">Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$num=0;
									$total_price = 0;
									if( !empty($this->item['orders']) ){
										foreach ($this->item['orders'] as $key => $value) {
											$num++;
											$total_price += $value['price'];
											?>
											<tr>
												<td class="ID"><?=$num?></td>
												<td class="name">
													<span class="fwb">
														<a href="<?=URL?>payments/<?=$value['id']?>" target="_blank"><?=$value['code']?></a>
													</span>
												</td>
												<td class="price"><?=number_format($value['price'],2)?></td>
											</tr>
											<?php
										}
									}else{
										echo '<td colspan="3" style="text-align:center; color:red;" class="fwb">No purchase information found.</td>';
									}
									?>
								</tbody>
								<tfoot>
									<th colspan="2" style="text-align: right;" class="fwb">Total</th>
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
