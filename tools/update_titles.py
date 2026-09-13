import pathlib
import re

BASE_DIR = pathlib.Path('resources/views')
PATTERN_SINGLE = re.compile(r"@section\('title',\s*'([^']*?) - Pondok Pesantren Al-Falah Krui'\)")
PATTERN_DOUBLE = re.compile(r'@section\("title",\s*"([^"]*?) - Pondok Pesantren Al-Falah Krui"\)')
PATTERN_CONCAT = re.compile(r" - Pondok Pesantren Al-Falah Krui")


def update_file(path: pathlib.Path) -> bool:
    original = path.read_text(encoding='utf-8')
    updated = PATTERN_SINGLE.sub(lambda m: f"@section('title', '{m.group(1)} - ' . $schoolName)", original)
    updated = PATTERN_DOUBLE.sub(lambda m: f"@section(\"title\", \"{m.group(1)} - \" . $schoolName)", updated)

    if updated == original:
        # Handle concatenated strings like $agenda->judul . ' - Pondok ...'
        updated = re.sub(
            r"(\$[A-Za-z_\->\[\]'\s]+)\.\s*' - Pondok Pesantren Al-Falah Krui'",
            lambda m: f"{m.group(1)} . ' - ' . $schoolName",
            original
        )

    if updated != original:
        path.write_text(updated, encoding='utf-8')
        return True
    return False


def main():
    updated_files = 0
    for file_path in BASE_DIR.rglob('*.blade.php'):
        if update_file(file_path):
            print(f"Updated {file_path}")
            updated_files += 1

    print(f"Total updated files: {updated_files}")


if __name__ == '__main__':
    main()

