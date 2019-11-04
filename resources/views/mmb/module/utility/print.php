<div class="box box-primary">
	<div class="box-header with-border"> </div>
	<div class="box-body">

<?php
	$content = '' ;
	$content .= '<table class="table table-striped table-bordered">';
	$content .= '<tr>';
	foreach($fields as $f )
	{
		if($f['download'] =='1')
		{
			$limited = isset($field['limited']) ? $field['limited'] :'';
			if(\App\Library\SiteHelpers::filterColumn($limited ))
			{
				$content .= '<th style="background:#f9f9f9;">'. $f['label'] . '</th>';

			}
		}
	}
	$content .= '</tr>';

	foreach ($rows as $row)
	{
		$content .= '<tr>';
		foreach($fields as $f )
		{
			if($f['download'] =='1'):
				$limited = isset($field['limited']) ? $field['limited'] :'';
				if(\App\Library\SiteHelpers::filterColumn($limited ))
				{
					$content .= '<td> '. \App\Library\SiteHelpers::formatRows($row->{$f['field']},$f,$row) . '</td>';
				}
			endif;
		}
		$content .= '</tr>';
	}
	$content .= '</table>';

	echo $content;
//	exit;


?>
	</div>
</div>



