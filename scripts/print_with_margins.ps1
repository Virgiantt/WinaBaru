param (
[string]$fileName
)

$lineWidth = 80

function center_text($text, $width) {
$padding = [math]::Max(0, ($width - $text.Length) / 2)
return (" " * $padding) + $text
}

$lines = Get-Content -Path $fileName
$formattedLines = @()

foreach ($line in $lines) {
if ($line -like "Name*Amount") {
$formattedLines += center_text($line, $lineWidth)
} else {
$formattedLines += $line
}
}

$formattedText = $formattedLines -join "`n"
$tempFile = "$env:TEMP\formatted_file.txt"
Set-Content -Path $tempFile -Value $formattedText -Encoding Ascii

Start-Process -FilePath "notepad.exe" -ArgumentList "/p $tempFile" -NoNewWindow -Wait
Remove-Item $tempFile
