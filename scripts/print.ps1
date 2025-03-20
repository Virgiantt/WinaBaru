param (
[string]$fileName
)

Start-Process -FilePath "notepad.exe" -ArgumentList "/p $fileName" -NoNewWindow -Wait
