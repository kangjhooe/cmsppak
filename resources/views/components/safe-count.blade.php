@props(['collection', 'key' => null, 'value' => null])

@php
    use App\Helpers\SafeCollectionHelper;
    
    if ($key && $value) {
        $count = SafeCollectionHelper::safeCount(SafeCollectionHelper::safeWhere($collection, $key, $value));
    } else {
        $count = SafeCollectionHelper::safeCount($collection);
    }
@endphp

{{ $count }}
