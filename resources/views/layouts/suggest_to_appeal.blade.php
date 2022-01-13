<script type="text/javascript">
    if (!confirm("Не желаете оставить отзыв?")) return

    let url = new URL("{{ route('appeal') }}");
    url.searchParams.append('sender', 'suggestion');
    window.location.replace(url);
</script>