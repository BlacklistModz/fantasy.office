<div class="clearfix">
	<h3 class="fwb"><i class="icon-list-alt"></i> รายการ ORDER (ประจำวันที่ <?=$this->periodStr?>)</h3>
	<a href="<?=URL?>pdf/reports?type=revenue?period_start=<?=$this->start?>&period_end=<?=$this->end?>" class="btn btn-blue rfloat" target="_blank"><i class="icon-print"></i> PRINT</a>
	<div ref="table" class="listpage2-table">
		<table class="table-bordered mtm">
			<thead>
				<tr>
					<th class="ID">ลำดับ</th>
					<th class="date">วันที่</th>
					<th class="address">เลขที่ Order</th>
					<th class="name">ชื่อร้าน / ชื่อผู้สั่ง</th>
					<th class="price">ราคารวม</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if( !empty($this->results['lists']) ) {
					$num = 1;
					foreach ($this->results['lists'] as $key => $value) {
						?>
						<tr>
							<td class="ID"><?=$num?></td>
							<td class="date"><?=date("d/m/Y", strtotime($value['date']))?></td>
							<td class="address"><?=$value['code']?></td>
							<td class="name"><?='['.$value['user_code'].'] '.$value['user_name']?></td>
							<td class="price"><?=number_format($value['net_price'], 2)?></td>
						</tr>
						<?php
						$num++;
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>