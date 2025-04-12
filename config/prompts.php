<?php

return [

    'openai' => [
        'copy_evaluation' => 'Evaluate the HTML file I\'ve attached and provide an analysis of the website\'s conversion optimization elements. 
                    You MUST respond with a valid JSON object using exactly the following format:
                    {
                        "messaging": {
                            "analysis": "Your overall thoughts on the messaging of this site, persuant to what you believe the website is trying to achieve.",
                            "responseOptions": "`Clear & direct`, `Mostly clear`, `Needs improvement`, or `Lacks focus`",
                            "rating": 0
                        },
                        "valueProposition": {
                            "analysis": "Your detailed analysis of the website\'s primary value proposition",
                            "rating": 0
                        },
                        "headline": {
                            "analysis": "Your evaluation of the primary <h1> element for clarity and conciseness",
                            "rating": 0,
                            "headlineValue: {
                                "current" : "The text content (include no html) of the first <h1> element found on the page.  It is *very* important that you take the text from within the <h1> tags exactly, and reference no other content on the page during this evaluation."
                                "suggested" : "A suggested, improved H1 text that will increase conversions, using normal casing"
                            }
                        },
                        "primaryCTA": {
                            "analysis": "Your analysis of the main call-to-action.  The main call-to-action is usually found in the first <section> or <div> of the page, and will likely be a <button> or an <a> element.  It should be the first link after parsing all the links in the <nav> element on the page.  Check class names for words like: primary, cta, or action.  It is important that you do not select a link or button in the navigation header.",
                            "rating": 0,
                            "primaryCTAValue: {
                                "current" : "The text content of the primary CTA element"
                                "suggested" : "A suggested, improved primary CTA element, using normal casing"
                            }
                        },
                        "conflictingCTAs": {
                            "analysis": "Your assessment of any competing or conflicting calls-to-action",
                            "rating": 0
                            "conflictingCTAsValue: {
                                "current" : "The conflicting CTAs, separated by commas"
                            }
                        },
                        "features": {
                            "analysis": "Your identification of the core product/service features discussed",
                            "rating": 0
                        },
                        "benefits": {
                            "analysis": "Your analysis of how well the site connects features to customer benefits",
                            "rating": 0
                        },
                        "benefitPresentation": {
                            "analysis": "Your evaluation of how benefits are presented and emphasized",
                            "rating": 0
                        },
                        "socialProof": {
                            "analysis": "Your assessment of testimonials, case studies, or other social proof elements.  If you find any class name that contains the word "testimonial" or "review", consider this a testimonial. If you find any case studies, please increase your rating for this category significantly",
                            "rating": 0
                        },
                        "associatedBrands": {
                            "analysis": "Your assessment of any associated brand images found on the page.  Check any image alt tags and class names for popular brands. Specifically: discuss their placement on the page.  If you find brand logos lower down in the HTML, this is a problem.",
                            "rating": 0
                        }
                        "overall": {
                            "analysis": "Your overall thoughts on what this website is trying to achieve and how well it does so",
                            "rating": 0
                        },
                        "conversionChance": {
                            "analysis": "Your overall thoughts on the likelihood of a site visitor ending up as a customer via this landing page, your rating should correspond with a standard grading system, so Very Likely is 90+, and Extremely Unlikely is anything under a 50.",
                            "responseOptions": "`Very likely`, `Likely`, `Somewhat likely`, `Unlikely`, `Very unlikely`, or `Extremely unlikely`"
                            "rating": 0
                        },
                        "mainImprovement": {
                            "analysis": "List briefly the ONE thing that this website should focus on to improve the likelyhood of a customer signup.",
                        },
                    }

                    IMPORTANT: The rating numbers shown above are PLACEHOLDERS ONLY. You must evaluate each element based on your expert analysis of the actual website content and assign ratings that genuinely reflect the quality of each element.

                    For each category, provide:
                    1. A concise but thorough analysis (100-150 words)
                    2. A numerical rating from 0-100, where:
                    - 0-20: Extremely poor or completely missing
                    - 21-40: Poor implementation with significant issues
                    - 41-60: Average implementation with clear room for improvement
                    - 61-80: Good implementation with minor opportunities for enhancement
                    - 81-100: Excellent implementation

                    DO NOT copy the example ratings. Each rating must be your own assessment based on the actual content of the website.

                    For each category, if you find a field named "responseOptions", your analysis MUST use ONE AND ONLY ONE of the text strings provided for that category.  Choose the one that seems most appropriate given your rating.

                    For your analysis in each section, please try to limit your character output to less then 300 characters.  Please wrap your text in a new <p> tag when a new line is appropriate (as you would expect in natural language text).

                    Your response MUST be a properly formatted JSON object as specified above with no additional text before or after.'
    ]

];
