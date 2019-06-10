
"PHP Storm project, synchronization tool v.1.0. Written by Jordan Pani on 5-27-2019."
"Language: Powershell Script."
"Purpose: Synchronize local host website with remote server by creating a local temp directory excepting certain files."
"---------------"
"Warning: you should backup the remote directory before proceeding."

$localFolder = "C:\sdme-home\public_html"
#$localFolder = "C:\sdme-temp\public_html_test" #test directory
#temp directory for local mirroring

$localTempFolder = "c:\sdme-temp\ready-for-remote-temp" 
$localTempFolderAndSlash = $localTempFolder + "\"


#Change this to all files and directories to exclude. This will use the -Recurse option ( of Remove-Item) to remove directories (search for -Recurse to change this)
$removeFiles = @("*.svn","_windows","codestyles","*.ps1","*.xml","*.cvs", ".idea","*.DS_Store", "*.git", "*.hg", "*.hprof","*.pyc", "*.psd") 

$HostName = "107.180.51.8"
$PortNumber = 21
$UserName = "jordanscp"
$Password = "StufU538.1"
#This needs Win SCP FTP program, set this to where you setup the program
$winSCPDllFileName = "C:\Program Files (x86)\WinSCP\WinSCPnet.dll";
$uploadDir = "/public_html"
#this option is useful to have if debugging because opening up connections without closing them happens alot when halting a program.
#then the server will refuse to make any new connections if over some limit.
$connectToRemoteNow = $true 
$tab = "`t"

##########################################

# Load WinSCP .NET assembly
Add-Type -Path $winSCPDllFileName


#Documented function used. WinSCP.SynchronizationResult returned by SynchronizeDirectories
#SynchronizeDirectories(WinSCP.SynchronizationMode mode, string localPath, string remotePath, bool removeFiles, bool mirror, WinSCP.SynchronizationCriteria criteria, WinSCP.TransferOptions options)
#see https://winscp.net/eng/docs/library_session_synchronizedirectories#powershell

#Parameters
#Name	Description
#SynchronizationMode mode	Synchronization direction. Possible values are SynchronizationMode.Local,  SynchronizationMode.Remote and SynchronizationMode.Both.
#string localPath	Full path to local directory.
#string remotePath	Full path to remote directory.
#bool removeFiles	When set to true, deletes obsolete files. Cannot be used for SynchronizationMode.Both.
#bool mirror	When set to true, synchronizes in mirror mode (synchronizes also older files). Cannot be used for SynchronizationMode.Both. Defaults to false.
#SynchronizationCriteria criteria	Comparison criteria. Possible values are SynchronizationCriteria.None,  SynchronizationCriteria.Time (default), SynchronizationCriteria.Size and SynchronizationCriteria.Either. For SynchronizationMode.Both SynchronizationCriteria.Time can be used only.
#TransferOptions options	Transfer options. Defaults to null, what is equivalent to new TransferOptions().


$synchMode = [WinSCP.SynchronizationMode]::Remote
$removeFilesDuringSynch = $true
$mirrorDuringSynch = $false
$synchCriteria = [WinSCP.SynchronizationCriteria]::Either



$startTime = Get-Date 

$tab + "Creating a new copy of the local website $localFolder at $localTempFolderAndSlash"

#file exists, removing temp directory
if (Test-Path -Path $localTempFolderAndSlash) 
{
    $tab + "Folder exists. Removing temp directory $localTempFolderAndSlash"
    Remove-Item "$localTempFolderAndSlash" -Recurse -Force 

    if (-not $?) { #check if the command did not succeed
        $tab + "Folder $localTempFolderAndSlash exists, and could not delete"
        $tab + "Aborting. This directory could be out of synch if the upload were to proceed."
        $tab + "Possible cause: folder could be opened by another program."
        $tab + "You should manually delete this directory or all of its children files before attempting a synchronization"    
        $tab + " or you could change the localTempCopyFolder variable in this code."
        return
    }
    
} 


$tab + "Creating empty directory at $localTempFolderAndSlash"
$result = mkdir -Path $localTempFolderAndSlash

if (-not $?) {#check if the command did not succeed
    "Error: Could not create folder $localTempFolderAndSlash . Exiting"
    return
}

$tab + "Copying $localFolder\* to $localTempFolderAndSlash"
Copy-Item "$localFolder\*" -Destination "$localTempFolderAndSlash" -Recurse

if (-not $?) {#check if the command did not succeed
    "Error: could not copy folder $localTempFolderAndSlash . Exiting. "
    return
}

$tab + "Removing exceptions."
#make all excluded files lower case for case insensitive comparison
for ($idx=0; $idx -lt $idx.Length; $idx++){
    $removeFiles[$idx] = $removeFiles[$idx].ToString().ToLower();
}

"The following files will be removed, effectively excluding them:   "
foreach($ef in $removeFiles) {
    "   $ef"
    Remove-Item "$localTempFolderAndSlash$ef" -Force -Verbose -Recurse
    if (-not $?) {
        "Skipping $localTempFolderAndSlash$ef"
    }
}
"`n" #newline

#$tab + "Creating a config file for the remote server."
#$tab + $tab + "Copying : $localTempFolderAndSlash$localConfigFile to $localTempFolderAndSlash$configFile"


#if (Test-Path -Path "$localTempFolderAndSlash$configFile"){
#    $tab + $tab + "File exists. Overwriting file."
#    #Remove-Item "$localTempFolderAndSlash$configFile" -Force        
#}

#Copy-Item -Path "$localTempFolderAndSlash$localConfigFile" -Destination "$localTempFolderAndSlash$configFile"
#if (-not $?) {#check if the command did not succeed
#    "Error: Could not copy Wordpress configuration file^^^"
#    if (-not (Test-Path -Path "$localTempFolderAndSlash$localConfigFile" ) ){
#        $tab + "File $localTempFolderAndSlash$localConfigFile does not exist!"
#    }
#
#    "Exiting. This copy operation needs to complete successfully before synchronization."
#    " or it the file will get deleted from the server and Wordpress would cease to function properly. $" + "removeFilesDuringSynch = $removeFilesDuringSynch"
#    return
#}

$tab + "Temporary directory $localTempFolderAndSlash is ready for uploading."



if (-not $connectToRemoteNow) {  
    'Warning: entering debug mode. $connectToRemoteNow = ' + $connectToRemoteNow + ". Not connecting to remote server!"
}


if (-not(Test-Path -Path $localTempFolderAndSlash)){
    "Directory $localTempFolderAndSlash does not exist! Exiting."
    Return
}        

function ShowFileCounts {
    $dir = $args[0]
    $dirCount = (Get-ChildItem -Directory -Force -Recurse $dir).Length
    $fileCount = (Get-ChildItem -File -Force -Recurse $dir).Length
    $totalCount = $dirCount + $fileCount
    $tab + "There are $fileCount files and $dirCount directories in $dir. Total: $totalCount" 
}

function ShowFileCountsPlusSelf {
    $dir = $args[0]
    
    $dirCount = (Get-ChildItem -Directory -Force -Recurse $dir).Length + 1 #add one for the directory itself
    $fileCount = (Get-ChildItem -File -Force -Recurse $dir).Length
    $totalCount = $dirCount + $fileCount
    $tab + "There are $fileCount files and $dirCount directories. Total: $totalCount" 
}
ShowFileCounts $localTempFolderAndSlash
$tab + $tab + "This includes nested (recursive), hidden and system files."    

"---------------"
"Starting remote session code..."

#-Force parameter shows hidden and system files
#-Recurse parameter recursive paths
#$topLevelFiles = Get-ChildItem $localTempFolderAndSlash -Force # | Where-Object {$_.PSISContainer} #only directories

$sessionStartTime = Get-Date 
try
{
    #start a new remote session
    $session = New-Object WinSCP.Session
    
    # Set up session options. Change this as needed
    $sessionOptions = New-Object WinSCP.SessionOptions -Property @{
        Protocol = [WinSCP.Protocol]::Ftp
        HostName =  $HostName
        PortNumber = $PortNumber
        UserName = $UserName
        Password = $Password
    }
    # Upload files
    $transferOptions = New-Object WinSCP.TransferOptions
    $transferOptions.TransferMode = [WinSCP.TransferMode]::Binary
    

    if ($connectToRemoteNow) {
        # Connect
        $tab + "Connecting to server " + $sessionOptions.HostName + ":" + $sessionOptions.PortNumber + "   User: " + $sessionOptions.UserName
        $session.Open($sessionOptions)
        $tab + $tab + "Session opened: " + $session.Opened + ".  Home Path: " + $session.HomePath 
        $tab + $tab + "There are " + $session.ListDirectory("/").Files.Count + " files + folders in the current directory."
        
        if (-not $session.Opened) {
            "Exiting. Could not make connection to server. Might look for log file at : " + $session.XmlLogPath 
            return
            
        }
    }
    "---------------"
    

    #SHOULD AUTOCOMPLETE / LOOK AT / CHECK SESSION METHODS 
    #SHOULD CHECK SESSION METHODS 
    #SHOULD CHECK SESSION METHODS 

    "Staring Synchronizing code with these options: " 
    "Synch. Mode: $synchMode, Remove files during Synch: $removeFilesDuringSynch, Mirror: $mirrorDuringSynch, Synch. Criteria: $synchCriteria, Transfer Options: $transferOptions "            
            
    #Enumerate the items array

    $filesUploaded = 0
    $fileBatchTransfers= 0
    $filesRemoved = 0



    #we are not ecluding the file. We are transferring it.
    $fileBatchTransfers++
    
    ##If the item is directory 
    $File = (Get-Item $localTempFolderAndSlash -Force )[0]
    if (-not($File.Attributes -eq "Directory")) {
        "Error file is not directory"
        return 
    }
        

    #$relativeName = ($File.FullName).Substring($localTempFolderAndSlash.Length + 1 ) 
    #$relativeName = $localTempFolderAndSlash
    #$fileFullName = $File.FullName + "*"
    $fileFullName = $localTempFolder 
    ####old $fileAndDirCount.ToString() + ": \$relativeName\"    #display directory to user
    ####old $relativeUploadPath = $uploadDir + $relativeName + "/"
    $relativeUploadPath = $uploadDir

    #get all the files being transfered in the directory, recursively
    #$Arr = @(Get-ChildItem $File.FullName -Force -Recurse) #force an array even if only one item in it
    #"Transferring directory. Number of files and directories included within this directory: " + ($Arr.Length + 1)
    #"(add 1 to any total for self directory. Not included in totals)"
    #ShowFileCountsPlusSelf $File.FullName

    $tab + "Attempting to synchronize local directory: '$fileFullName' to remote directory: $relativeUploadPath  (connected=$connectToRemoteNow)"

    if ($connectToRemoteNow) {
        
        #check if remote directory exists, if not create it, otherwise synching will throw an error
        if ($session.FileExists($relativeUploadPath)) {
            $tab + "Remote directory exists."
        } else {
            $tab + "Remote directory does not exist. Creating directory."
            $session.CreateDirectory($relativeUploadPath)
            $filesUploaded++
        }                       
        
        $tab + "For WinSCP API parameters, see https://winscp.net/eng/docs/library_powershell#net"
        #Usage: $result = $session.SynchronizeDirectories([WinSCP.SynchronizationMode]::Ftp, $fileFullName, $relativeUploadPath, $removeFilesDuringSynch, $mirrorDuringSynch, [WinSCP.SynchronizationCriteria]::None, $transferOptions)
        $tab + $tab + "Calling session.SynchronizeDirectories(synchMode, fileFullName, relativeUploadPath, removeFilesDuringSynch, mirrorDuringSynch, synchCriteria, transferOptions) with the following arguments."
        $tab + $tab + "session.SynchronizeDirectories($synchMode, $fileFullName, $relativeUploadPath, $removeFilesDuringSynch, $mirrorDuringSynch, $synchCriteria, $transferOptions)"
        
        $synchResult = $session.SynchronizeDirectories($synchMode, $fileFullName, $relativeUploadPath, 
            $removeFilesDuringSynch, $mirrorDuringSynch, $synchCriteria, $transferOptions) ##WinSCP.SynchronizationResult  returned
        
        $tab + "Synchronization result:   Success: " + $synchResult.IsSuccess + "  Downloads: " + $synchResult.Downloads.Count + "  Uploads: " + $synchResult.Uploads.Count+ "  Removals: " + $synchResult.Removals.Count + "  Failures: " + $synchResult.Failures.Count +  " "  
        $filesUploaded +=$synchResult.Uploads.Count
        $filesRemoved += $synchResult.Removals.Count

        #Properties
        #Name	Description
        #TransferEventArgsCollection Downloads	Collection of downloads. See TransferEventArgs. Read-only.
        #SessionRemoteExceptionCollection Failures	Collection of all errors that occured during batch operation. See  SessionRemoteException. See also Capturing results of operations. Read-only. (Inherited from OperationResultBase.)
        #bool IsSuccess	Is true, if Failures is empty collection. Read-only. (Inherited from  OperationResultBase.)
        #TransferEventArgsCollection Uploads	Collection of uploads. See TransferEventArgs. Read-only.
        #RemovalEventArgsCollection Removals

        try {
            $synchResult.Check()
        } Catch {

            $exNum = 0
            foreach($ex in $synchResult.SessionRemoteExceptionCollection) {
                $exNum++
                
                "Remote Failure #" + $exNum + ": " + $ex.Message + " : " + $ex.ToString()
            }
        }
    }

    # Print results
    if ($transferResult) { #we transferred something successfully
        $tab + "Checking transfer results..."
        # Throw on any error
        $transferResult.Check()

        $filesInBatch = 0 #when done counting will be total number of files transfered at once
        foreach ($transfer in $transferResult.Transfers) #loop through all files transfered
        {
            $filesInBatch++ 
            $filesUploaded++ #total files transfered this session.
            $tab + $tab + "  $filesInBatch - Upload of $($transfer.FileName) succeeded" #display each file transfered
        }
        $tab + "$filesInBatch Files in batch uploaded."
    }
        
    
    
    "---------------"
    "Total files and folders uploaded: $filesUploaded"
} Catch {
    $ErrorMessage = $_.Exception.Message
    "The error message was $ErrorMessage"
}
finally
{
    "Closing remote session."
    $session.Dispose()
}



$endTime = Get-Date
$sessionEndTime = $endTime

$completeDiffTime = New-TimeSpan -start $startTime -end $endTime
$sessionDiffTime = New-TimeSpan -start $sessionStartTime -end $sessionEndTime
"Remote session lasted " + $sessionDiffTime.TotalSeconds.ToInt32($Null) + " seconds."
"Entire operation lasted " + $completeDiffTime.TotalSeconds.ToInt32($Null) + " seconds."