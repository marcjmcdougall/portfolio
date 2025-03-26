<x-mail::message>
![Image of {{ $quickScan->url }}]({{ asset( '/storage/' . $quickScan->screenshot_path->getValue() ) }})
# CRO QuickScan has been completed. ✅ 

Your landing page has taken the first step towards becoming a lead generation **machine**.

Check it out at the link below:

<x-mail::button :url="route('quick-scan.show', ['quickScan' => $quickScan, 'domain' => $quickScan->domain])" color="primary">
    View Your QuickScan
</x-mail::button>

<x-mail::panel>
**P.S.** If you want a software conversion specialist to review this with you, feel free to [snag 15 mins with me](https://calendly.com/kbs-marc/hello).
</x-mail::panel>

Talk soon,<br>
–Marc
</x-mail::message>
