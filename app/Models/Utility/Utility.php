<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Utility extends Model
{

	public static function getIcon($extension)
	{
		$icon = "";
		switch($extension){
			case "png":
			case "jpg":
			case "gif":
			case "bmp":
				$icon = "<i class='fa fa-file-image-o'></i>";
				break;

			case "pdf":
			case "PDF":
				$icon = "<i class='fa fa-file-pdf-o'></i>";
				break;

			case "xls":
			case "xlsx":
			case "xlsm":
				$icon = "<i class='fa fa-file-excel-o'></i>";
				break;

			case "mp4":
			case "avi":
			case "mov":
				$icon = "<i class='fa fa-film'></i>";
				break;

			case "doc":
			case "docx":
				$icon = "<i class='fa fa-file-word-o'></i>";
				break;

			case "mp3":
			case "wav":
				$icon = "<i class='fa fa-file-audio-o'></i>";
				break;

			case "ppt":
			case "pptx":
				$icon = "<i class='fa fa-file-powerpoint-o'></i>";
				break;

			case "zip":
				$icon = "<i class='fa fa-file-archive-o'></i>";
				break;

			case "html":
			case "css":
			case "js":
				$icon = "<i class='fa fa-file-code-o'></i>";
				break;

			default:
				$icon = "<i class='fa fa-file-o'></i>";
				break;
		}
		return $icon;
	}

	public static function getModalLink($file, $anchortext, $extension, $id, $withIcon=null, $justAnchor=null)
	{
		if($withIcon){
			$icon = Utility::getIcon($extension). " ";
		} else {
			$icon = "";
		}

		switch($extension){
			case "png":
			case "jpg":
			case "gif":
			case "bmp":
				$class = 'launchImageViewer';
				$modalTarget = '#imageviewmodal';
				break;

			case "pdf":
			case "PDF":
				$class = 'launchPDFViewer';
				$modalTarget = '#fileviewmodal';
				break;

			case "xls":
			case "xlsx":
			case "xlsm":
				$class = 'download';
				$modalTarget = 'ExcelDownload';
				break;

			case "mp4":
			case "avi":
			case "mov":
			case "webm":
				$class = 'launchVideoViewer';
				$modalTarget = '#videomodal';
				break;

			case "doc":
			case "docx":
				$class = 'download';
				$modalTarget = '#';
				break;

			case "mp3":
			case "wav":
				$class = 'newwindow';
				$modalTarget = '#';
				break;

			case "ppt":
			case "pptx":
				$class = 'download';
				$modalTarget = '#';
				break;

			case "zip":
				$class = 'download';
				$modalTarget = '#';
				break;

			case "html":
				$class = 'newwindow';
				$modalTarget = '#';
				break;

			case "css":
			case "js":
			default:
				$class = 'nolink';
				$modalTarget = '#';
				break;
		}

		switch($class){
			
			case "launchImageViewer":
				$link = '<a href="#">'.$icon.$anchortext.'</a>';
				$anchorOnly = "<a href=''>";
				break;

			case "launchPDFViewer":
				$link = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/viewer/?file=/files/'.$file.'" data-target="#fileviewmodal">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/viewer/?file=/files/'.$file.'" data-target="#fileviewmodal">';
				// $link = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/files/'.$file.'" data-target="#fileviewmodal">'.$icon.$anchortext.'</a>';
				// $anchorOnly = '<a href="#" class="launchPDFViewer trackclick" data-res-id="'.$id.'" data-toggle="modal" data-file="/viewer/?file=/files/'.$file.'" data-target="#fileviewmodal">';
				break;

			case "launchVideoViewer":
				$link = '<a href="#" class="launchVideoViewer trackclick" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#videomodal">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="#" class="launchVideoViewer trackclick" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#videomodal">';
				break;

			case "download":
				$link = '<a href="/files/'.$file.'" class="trackclick" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="/files/'.$file.'" class="trackclick" data-res-id="'.$id.'" data-file="'.$file.'" data-target="#">';
				break;

			case "newwindow":
				$link = '<a href="/files/'.$file.'" class="trackclick" target="_blank">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="/files/'.$file.'" class="trackclick" target="_blank">';
				break;

			case "nolink":
				$link = '<a href="#">'.$icon.$anchortext.'</a>';
				$anchorOnly = '<a href="#">';
				break;

			default:
				$link = "";
				break;
		}

		if($justAnchor){
			return $anchorOnly;
		}

		return $link;
	}

	public static function getAlertIcon()
	{
		return "<i class='fa fa-bell-o'></i>";
	}

	public static function prettifyDate($date)
	{
		if($date == '0000-00-00 00:00:00') {
			return "";
		}
		//$prettyDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('D, M d, Y h:i a');
		$prettyDate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('D, M d, Y');
		return $prettyDate;
	}

	public static function getTimePastSinceDate($date)
	{
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
		$since = Carbon::now()->diffForHumans($date, true);
		return $since;
	}

}
