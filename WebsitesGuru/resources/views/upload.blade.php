<form action="/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button type="submit">Upload</button>
</form>

<td>
    <a href="{{$item['youtube']}}" target="_blank">{{$item['youtube']}}</a><br>
    <?php
    $pattern = '/(?:https?:\/\/)?(?:www\.)?youtu(?:\.be|be\.com)\/(?:watch\?v=|embed\/|v\/)?([\w\-_]+)/i';
    preg_match($pattern, $item['youtube'], $matches);

    if (isset($matches[1])) {
      $videoId = $matches[1];

      // Form the thumbnail URL
      $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";

      // Display the thumbnail as a clickable link
      echo '<a href="https://www.youtube.com/watch?v=' . $videoId . '" target="_blank">';
      echo '<img src="'.$thumbnailUrl.'" alt="Thumbnail">';
      echo '</a>';
    }
    ?>
  </td>
