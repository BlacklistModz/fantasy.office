<div id="mainContainer" class="report-main clearfix" data-plugins="main">
	<div role="content">
		<div role="main" class="pal">
			<div class="uiBoxWhite pas pam">
				<div class="clearfix">
					<div class="lfloat">
						<h3 class="fwb"><i class="icon-line-chart"></i> รายงานรายรับ</h3>
					</div>
					<div class="lfloat" style="margin-left: 5mm;">
						<ul>
							<li class="clearfix">
								<label class="fwb fcg fsm" for="closedate">แสดงวันที่</label>
								<select selector="closedate" name="closedate" class="inputtext"></select>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="uiBoxWhite pas pam" style="margin-top: 2mm;">
				<div id="total"></div>
			</div>
			<div class="uiBoxWhite pas pam" style="margin-top: 2mm;">
				<div id="table-lists"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('[selector=closedate]').closedate({
		leng:"th",
		options: [
			{
				text: 'วันนี้',
				value: 'daily',
			},
			{
				text: 'เมื่อวานนี้',
				value: 'yesterday',
			},
			{
				text: 'สัปดาห์นี้',
				value: 'weekly',
			},
			{
				text: 'เดือนนี้',
				value: 'monthly', 
			},
			{
				text: 'กำหนดเอง',
				value: 'custom',
			}
		],
		onChange:function(date){
			$.get(Event.URL + 'reports/revenue', {period_start:date.startDateStr, period_end:date.endDateStr, main:1}, function(res){
				$('#table-lists').html( res );
				Event.plugins( $('#table-lists') );
			});
			$.get(Event.URL + 'reports/revenue_total', {period_start:date.startDateStr, period_end:date.endDateStr, main:1}, function(res){
				$('#total').html( res );
				Event.plugins( $('#total') );
			});
		},
	});
</script>