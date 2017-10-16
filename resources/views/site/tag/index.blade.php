This is the tag: {{ $tagId }}

<table>

<tr style="font-weight: bold;">
    <td>id</td>
    <td>content id</td>
    <td>content type</td>
    <td>tag id</td>
</tr>
@foreach($content as $c)
<tr>
    <td>{{ $c->id }}</td>
    <td>{{ $c->content_id }}</td>
    <td>{{ $c->content_type }}</td>
    <td>{{ $c->tag_id }}</td>
</tr>
@endforeach
</table>
