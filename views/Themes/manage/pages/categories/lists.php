<div id="mainContainer" class="profile clearfix" data-plugins="main">

	<div data-plugins="ManageCategories">
		<div role="main" class="pal">
			
			<div style="max-width: 750px">
				
				<div class="mbm clearfix">
					<div class="lfloat">
						<h2><i class="icon-database mrs"></i>หมวดหมู่สินค้า</h2>
						<span style="color:blue;" class="fwb mts">* ให้คลิ๊กที่ชื่อของหมวดหมู่ค้างไว้ และลากขึ้น หรือลากลงได้ตามต้องการ</span>
					</div>
					<div class="rfloat">
						<a href="<?=URL?>categories/add" class="btn btn-blue" data-plugins="dialog"><i class="icon-plus"></i> เพิ่ม</a>
					</div>
				</div>
				<!-- <div class="uiBoxYellow pam mbm">กดลากเพื่อจัดลำดับ ประเภทโปรแกรมทัวร์</div> -->

				<ul class="listsdata-table-lists">
					<li class="head">
						<div class="ID"><label class="label">ลำดับ</label></div>
						<div class="name"><label class="label">หมวดหมู่สินค้า</label></div>
						<div class="num"><label class="label">จำนวนสินค้า</label></div>
						<div class="date"><label class="label">สถานะ</label></div>
						<div class="actions"><label class="label">จัดการ</label></div>
					</li>
				</ul>
				<ul class="listsdata-table-lists" rel="listsbox">
					<?php 
					$seq = 0;
					foreach ($this->results['lists'] as $key => $value) { 
						$seq++;

						?>
						<li class="list seq-item" data-id="<?=$value['id']?>">
							<div class="ID fwb"><span class="seq"><?=$seq?></span></div>
							<div class="name"><span class="fwb"><a class="fwb"><?=$value['name_th']?> (<?=$value['name_en']?>)</span></a></div>
							<div class="num tac">
								<?=!empty($value['product_count']) ? $value['product_count']: '-'?>
							</div>
							<div class="date">
								<?= $value['status'] == "A" ? "Active" : "Inactive" ?>
							</div>
							<div class="actions tac">
								<span class="gbtn">
									<a href="<?=URL?>categories/edit/<?=$value['id']?>" class="btn btn-no-padding btn-orange" data-plugins="dialog"><i class="icon-pencil"></i></a>
								</span>
								<span class="gbtn">
									<a href="<?=URL?>categories/del/<?=$value['id']?>" class="btn btn-no-padding btn-red" data-plugins="dialog"><i class="icon-trash"></i></a>
								</span>
							</div>
						</li>
						<?php }?> 

					</ul>
				</div>

			</div>


		<!-- <div role="footer">
			<div class="pal clearfix" style="max-width: 750px">
				<div class="rfloat"><a class="btn btn-blue">Save</a></div>
			</div>
		</div> -->

	</div>
</div>

