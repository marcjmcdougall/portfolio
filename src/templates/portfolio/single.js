import React, { useState } from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import BackgroundImage from 'gatsby-background-image'
import LayoutStandard from '../../components/layouts/Standard' 
import { PopupText } from "react-calendly"

export default function SinglePortfolio({data}) {

	const post = data.allWpPortfolio.nodes[0]
	const localFiles = data.allFile.nodes;
	const [active, setActive] = useState('overview');
	const [hovering, setHovering] = useState(false);

	var headerButton;

	if(post.portfolioData.linkToSite){

		const siteUrl = post.portfolioData.siteUrl.url;
		headerButton = "<a href='" + siteUrl + "' target='_blank' rel='noreferrer' class='button figma'>" + '<svg class="left" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 300"><style type="text/css">.st0{fill:#0acf83}.st1{fill:#a259ff}.st2{fill:#f24e1e}.st3{fill:#ff7262}.st4{fill:#1abcfe}</style><title>Figma.logo</title><desc>Created using Figma</desc><path id="path0_fill" class="st0" d="M50 300c27.6 0 50-22.4 50-50v-50H50c-27.6 0-50 22.4-50 50s22.4 50 50 50z"/><path id="path1_fill" class="st1" d="M0 150c0-27.6 22.4-50 50-50h50v100H50c-27.6 0-50-22.4-50-50z"/><path id="path1_fill_1_" class="st2" d="M0 50C0 22.4 22.4 0 50 0h50v100H50C22.4 100 0 77.6 0 50z"/><path id="path2_fill" class="st3" d="M100 0h50c27.6 0 50 22.4 50 50s-22.4 50-50 50h-50V0z"/><path id="path3_fill" class="st4" d="M200 150c0 27.6-22.4 50-50 50s-50-22.4-50-50 22.4-50 50-50 50 22.4 50 50z"/></svg>' + "View In Figma " + '<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg>' +  "</a>";
	}
	else{

		headerButton = '';
	}
	
  	return (

  		<LayoutStandard title={"Case Study: " + post.title} description={post.portfolioData.projectSimpleDescription} image={post.featuredImage}>

	  		<div class="container">

		  		<section className="row page-title">

		  			<div className="col-8">

		  				<h1>{post.title}</h1>
		  				<ul class="meta">

		  				{post.portfolioCategories.nodes.map(portfolioCategory => (

				  					<li>{portfolioCategory.name}</li>

					  		))}

		  					{post.portfolioTags.nodes.map(portfolioTag => (

				  					<li>{portfolioTag.name}</li>

					  		))}

		  				</ul>
		  				<p>{post.portfolioData.projectSimpleDescription}</p>

		  			</div>

		  			<div className={'col-4 right visitButton' + (post.portfolioData.linkToSite ? '' : 'hidden')}  dangerouslySetInnerHTML={{ __html: headerButton }} />

		  		</section>

		  	</div>

		  	{/*Shows the gallery conditionally.*/}
		  	
		  		<section id="portfolio-gallery" onMouseEnter={function(){ setHovering(true); }} onMouseLeave={function(){ setHovering(false); }}>

		  		<div className="container">

			  		<div className="row">

			  			<div className="col-12">	

			  				{post.portfolioData.productGallery ? (

			  				<div className="gallery"style={{ width: `calc((810px * (${post.portfolioData.productGallery.length} + 1)) + 90px)`}}>

				  					<p className={hovering ? 'scroll-indicator showing' : 'scroll-indicator'}><svg width="77" height="30" viewBox="0 0 77 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="77" height="30" rx="15" fill="#E6E7E8"/><g opacity="0.86"><path d="M17.9998 8.33325C18.2209 8.33325 18.4328 8.42105 18.5891 8.57733L23.5891 13.5773C23.9145 13.9028 23.9145 14.4304 23.5891 14.7558C23.2637 15.0813 22.736 15.0813 22.4106 14.7558L18.8332 11.1784L18.8332 20.8333C18.8332 21.2935 18.4601 21.6666 17.9998 21.6666C17.5396 21.6666 17.1665 21.2935 17.1665 20.8333L17.1665 11.1784L13.5891 14.7558C13.2637 15.0813 12.736 15.0813 12.4106 14.7558C12.0851 14.4304 12.0851 13.9028 12.4106 13.5773L17.4106 8.57733C17.5669 8.42105 17.7788 8.33325 17.9998 8.33325Z" fill="#1F252F"/></g><path d="M40.625 12.4205C40.5644 11.8826 40.3144 11.4659 39.875 11.1705C39.4356 10.8712 38.8826 10.7216 38.2159 10.7216C37.7386 10.7216 37.3258 10.7973 36.9773 10.9489C36.6288 11.0966 36.358 11.3011 36.1648 11.5625C35.9754 11.8201 35.8807 12.1136 35.8807 12.4432C35.8807 12.7197 35.9451 12.9583 36.0739 13.1591C36.2064 13.3598 36.3788 13.5284 36.5909 13.6648C36.8068 13.7973 37.0379 13.9091 37.2841 14C37.5303 14.0871 37.767 14.1591 37.9943 14.2159L39.1307 14.5114C39.5019 14.6023 39.8826 14.7254 40.2727 14.8807C40.6629 15.036 41.0246 15.2405 41.358 15.4943C41.6913 15.7481 41.9602 16.0625 42.1648 16.4375C42.3731 16.8125 42.4773 17.2614 42.4773 17.7841C42.4773 18.4432 42.3068 19.0284 41.9659 19.5398C41.6288 20.0511 41.1383 20.4545 40.4943 20.75C39.8542 21.0455 39.0795 21.1932 38.1705 21.1932C37.2992 21.1932 36.5455 21.0549 35.9091 20.7784C35.2727 20.5019 34.7746 20.1098 34.4148 19.6023C34.0549 19.0909 33.8561 18.4848 33.8182 17.7841H35.5795C35.6136 18.2045 35.75 18.5549 35.9886 18.8352C36.2311 19.1117 36.5398 19.3182 36.9148 19.4545C37.2936 19.5871 37.7083 19.6534 38.1591 19.6534C38.6553 19.6534 39.0966 19.5758 39.483 19.4205C39.8731 19.2614 40.1799 19.0417 40.4034 18.7614C40.6269 18.4773 40.7386 18.1458 40.7386 17.767C40.7386 17.4223 40.6402 17.1402 40.4432 16.9205C40.25 16.7008 39.9867 16.5189 39.6534 16.375C39.3239 16.2311 38.9508 16.1042 38.5341 15.9943L37.1591 15.6193C36.2273 15.3655 35.4886 14.9924 34.9432 14.5C34.4015 14.0076 34.1307 13.3561 34.1307 12.5455C34.1307 11.875 34.3125 11.2898 34.6761 10.7898C35.0398 10.2898 35.5322 9.90151 36.1534 9.625C36.7746 9.3447 37.4754 9.20455 38.2557 9.20455C39.0436 9.20455 39.7386 9.3428 40.3409 9.61932C40.947 9.89583 41.4242 10.2765 41.7727 10.7614C42.1212 11.2424 42.303 11.7955 42.3182 12.4205H40.625ZM46.1666 15.8182V21H44.4677V9.36364H46.1439V13.6932H46.2518C46.4564 13.2235 46.7689 12.8504 47.1893 12.5739C47.6098 12.2973 48.159 12.1591 48.837 12.1591C49.4355 12.1591 49.9583 12.2822 50.4052 12.5284C50.856 12.7746 51.2045 13.142 51.4507 13.6307C51.7007 14.1155 51.8257 14.7216 51.8257 15.4489V21H50.1268V15.6534C50.1268 15.0133 49.962 14.517 49.6325 14.1648C49.3029 13.8087 48.8446 13.6307 48.2575 13.6307C47.856 13.6307 47.4961 13.7159 47.1779 13.8864C46.8636 14.0568 46.6154 14.3068 46.4336 14.6364C46.2556 14.9621 46.1666 15.3561 46.1666 15.8182ZM54.1215 21V12.2727H55.8204V21H54.1215ZM54.9795 10.9261C54.684 10.9261 54.4302 10.8277 54.2181 10.6307C54.0098 10.4299 53.9056 10.1913 53.9056 9.91477C53.9056 9.63447 54.0098 9.39583 54.2181 9.19886C54.4302 8.99811 54.684 8.89773 54.9795 8.89773C55.2749 8.89773 55.5268 8.99811 55.7352 9.19886C55.9473 9.39583 56.0533 9.63447 56.0533 9.91477C56.0533 10.1913 55.9473 10.4299 55.7352 10.6307C55.5268 10.8277 55.2749 10.9261 54.9795 10.9261ZM62.2881 12.2727V13.6364H57.3563V12.2727H62.2881ZM58.7086 21V11.2614C58.7086 10.7159 58.8279 10.2633 59.0665 9.90341C59.3051 9.53977 59.6214 9.26894 60.0154 9.09091C60.4093 8.90909 60.8373 8.81818 61.2995 8.81818C61.6404 8.81818 61.932 8.84659 62.1745 8.90341C62.4169 8.95644 62.5968 9.00568 62.7142 9.05114L62.3165 10.4261C62.237 10.4034 62.1347 10.3769 62.0097 10.3466C61.8847 10.3125 61.7332 10.2955 61.5551 10.2955C61.1423 10.2955 60.8468 10.3977 60.6688 10.6023C60.4945 10.8068 60.4074 11.1023 60.4074 11.4886V21H58.7086ZM68.1436 12.2727V13.6364H63.3766V12.2727H68.1436ZM64.655 10.1818H66.3538V18.4375C66.3538 18.767 66.4031 19.0152 66.5016 19.1818C66.6 19.3447 66.7269 19.4564 66.8822 19.517C67.0413 19.5739 67.2137 19.6023 67.3993 19.6023C67.5357 19.6023 67.655 19.5928 67.7572 19.5739C67.8595 19.5549 67.9391 19.5398 67.9959 19.5284L68.3027 20.9318C68.2042 20.9697 68.0641 21.0076 67.8822 21.0455C67.7004 21.0871 67.4732 21.1098 67.2004 21.1136C66.7535 21.1212 66.3368 21.0417 65.9504 20.875C65.5641 20.7083 65.2516 20.4508 65.0129 20.1023C64.7743 19.7538 64.655 19.3163 64.655 18.7898V10.1818Z" fill="#1F252F"/></svg>
	 + scroll for more&hellip;</p>
				  					
	 									{post.portfolioData.productGallery.map(galleryItem => (

							  			<div className="gallery-wrap">

					  						<Img fluid={galleryItem.localFile.childImageSharp.fluid} className="gallery-item"/>
					  						<div className="subtitle" dangerouslySetInnerHTML={{ __html: galleryItem.caption }}></div>

					  					</div>

						  			))}

			  				</div>

			  				) : ( 

			  					<div className="gallery">

			  						<div className="gallery-wrap">

			  							<Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid} className="gallery-item"/>

			  						</div>

			  					</div>

			  				) }

			  			</div>

			  		</div>

			  	</div>

		  	</section>

		  	<section id="tags" className="row">

          <div className="container">

            <div className="col-12">

              <ul className="tags portfolio">

                <li><a className={active === 'overview' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('overview'); console.log(active); }}>Overview</a></li>
                <li className={post.portfolioData.showcasestudy}><a className={active === 'case-study' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('case-study'); console.log(active);}}>Case Study</a></li>

              </ul>

            </div>

            </div>

        </section>

	  		<section id="portfolio-body" className="container">

	  			<div className={((active === 'overview') ? 'row active' : 'row' )}>

		  			<div className="col-12 blog-content">

		  			<div className="wrapper">

		  				<div class="wrap">

		  					<h2>Problem</h2>

		  					<div dangerouslySetInnerHTML={{ __html: post.portfolioData.problem }}></div>
	
		  				</div>

		  				<div class="wrap">

		  					<h2>Solution</h2>

		  					<div dangerouslySetInnerHTML={{ __html: post.portfolioData.solution }}></div>

		  				</div>

		  				{post.portfolioData.resultsList ? ( 

		  				<div class="wrap">
		  				
		  					<h2>Results</h2>

		  					<ul class="results-wrapper">


		  						{post.portfolioData.resultsList.map(listItem => (

							  			<li className="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
{listItem.text}</li>

						  			))}

		  					</ul>

		  				</div>

		  				) : null}

		  				{post.portfolioData.testimonial ? ( 

		  				<div class="wrap">
		  				
		  					<div className="archive-testimonial">

					  				<p>"{post.portfolioData.testimonial.testimonialData.testimonial}"</p>

					  				{post.portfolioData.testimonial.testimonialData.profileImage ? <Img fluid={post.portfolioData.testimonial.testimonialData.profileImage.localFile.childImageSharp.fluid}/> : null }

							        <div className="text-content">
							          <h4>{post.portfolioData.testimonial.title}</h4>
							          <p>{post.portfolioData.testimonial.testimonialData.siteName}</p>
							        </div>
							    </div>

		  				</div>

		  				) : null }

 						<div className={'visitButton' + (post.portfolioData.linkToSite ? '' : 'hidden')}  dangerouslySetInnerHTML={{ __html: headerButton }} />

		  			</div>

		  			</div>

		  		</div>

	  			<div className={((active === 'case-study') ? 'row active' : 'row' )}>

		  			<div className="col-12 blog-content">

		  				<div className="wrapper" dangerouslySetInnerHTML={{ __html: post.content }}/>

		  			</div>

		  		</div>

	  		</section>

  		</LayoutStandard>
  	)
}

export const query = graphql`
  query($slug: String!) {
    allWpPortfolio(filter: { slug: { eq: $slug } }) {
      nodes {
        title
        content
        portfolioTags{
        	nodes{
        		name
        	}
        }
        portfolioCategories{
        	nodes{
        		name
        	}
        }
        portfolioData {
        	showcasestudy
        	problem
        	solution
        	resultsList{
        		text
        	}
        	testimonial {
	          ... on WPTestimonial {
	            id
	            testimonialData {
	              siteName
	              testimonial
	              profileImage {
				          localFile {
				            childImageSharp {
				              fluid {
				                ...GatsbyImageSharpFluid
				              }
				            }
				          }
				        }
	            }

	            title
	          }
	        }
        	productGallery{
        		caption
        		localFile {
        			childImageSharp {
	              fluid {
	                ...GatsbyImageSharpFluid
	              }
	            }
        		}
        	}
		      siteUrl {
		        url
		      }
		      projectSimpleDescription
		      linkToSite
		      sidebarImage {
		          localFile {
		            childImageSharp {
		              fluid {
		                ...GatsbyImageSharpFluid
		              }
		            }
		          }
		        }
		    }
        featuredImage {
	        node {
	          localFile {
	            childImageSharp{
	            	fluid{
	            		...GatsbyImageSharpFluid
	            	}
	            }
	          }
	        }
	      }
      }
    }
    allFile(filter: {absolutePath: {regex: "/"  }}) {
	    nodes {
	      relativePath
	      name
	      childImageSharp {
	        fluid{
	        	...GatsbyImageSharpFluid
	        }
	        fixed(width: 400, height: 400) {
			      ...GatsbyImageSharpFixed
			    }
	      }
	    }
	  }
  }
`
