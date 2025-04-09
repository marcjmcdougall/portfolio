
<x-mail::message>
![Image of {{ $quickScan->domain }}]({{ asset( '/storage/' . $quickScan->screenshot_path->getValue() ) }})
# CRO QuickScan has been completed. ✅

Here's the details:
* **Domain:** {{ $quickScan->domain }}
* **Full URL:** {{ $quickScan->url }}
* **Email:** {{ $quickScan->email }}

Check it out at the link below:

<x-mail::button :url="route('quick-scan.show', ['quickScan' => $quickScan, 'domain' => $quickScan->domain])" color="primary">
    View This QuickScan
</x-mail::button>

– Marc
</x-mail::message>
