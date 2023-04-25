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

	var headerButton;

	if(post.portfolioData.linkToSite){

		const siteUrl = post.portfolioData.siteUrl.url;
		headerButton = "<a href='" + siteUrl + "' target='_blank' rel='noreferrer' class='button'>View In Figma " + '<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg>' +  "</a>";
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
		  					
		  					<li><Link to={'/portfolio/'}>Product UI</Link></li>
		  					<li><Link to={'/portfolio/'}>Machine Learning</Link></li>

		  				</ul>
		  				<p>{post.portfolioData.projectSimpleDescription}</p>

		  			</div>

		  			<div className={'col-4 right visitButton' + (post.portfolioData.linkToSite ? '' : 'hidden')}  dangerouslySetInnerHTML={{ __html: headerButton }} />

		  		</section>

		  	</div>

		  	<section id="portfolio-gallery">

		  		<div className="container">

			  		<div className="row">

			  			<div className="col-12">

			  				<p>Shift + scroll for more&hellip;</p>
			  				<div className="gallery">
			  					
			  					<Img fluid={localFiles.find(n => n.name == 'placeholder').childImageSharp.fluid} className="gallery-item"/>
			  					<Img fluid={localFiles.find(n => n.name == 'placeholder').childImageSharp.fluid} className="gallery-item"/>

			  				</div>

			  			</div>

			  		</div>

			  	</div>

		  	</section>

		  	<section id="tags" className="row">

          <div className="container">

            <div className="col-12">

              <ul className="tags portfolio">

                <li><a className={active === 'overview' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('overview'); console.log(active); }}>Overview</a></li>
                <li><a className={active === 'case-study' ? 'button active' : 'button'} href="#!" onClick={function(){ setActive('case-study'); console.log(active);}}>Case Study</a></li>

              </ul>

            </div>

            </div>

        </section>

	  		<section id="portfolio-body" className="container">

	  			<div className={((active === 'overview') ? 'row active' : 'row' )}>

		  			<div className="col-12 blog-content">

		  				<div class="wrap">

		  					<h2>Problem</h2>
		  					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

		  				</div>

		  				<div class="wrap">

		  					<h2>Solution</h2>
		  					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

		  				</div>

		  				<div class="wrap">
		  				
		  					<h2>Results</h2>

		  					<ul class="results-wrapper">
		  						
		  						<li class="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
Finish projects much faster</li>
									<li class="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
Finish projects much faster</li>
									<li class="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
Finish projects much faster</li>
									<li class="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
Finish projects much faster</li>
									<li class="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
Finish projects much faster</li>
									<li class="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
Finish projects much faster</li>
									<li class="result"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.2203 4.37713C17.5643 4.68289 17.5953 5.20962 17.2895 5.5536L8.40063 15.5536C8.24249 15.7315 8.01582 15.8333 7.77779 15.8333C7.53975 15.8333 7.31309 15.7315 7.15495 15.5536L2.7105 10.5536C2.40474 10.2096 2.43572 9.68289 2.77971 9.37713C3.12369 9.07136 3.65042 9.10235 3.95618 9.44633L7.77779 13.7456L16.0438 4.44633C16.3496 4.10235 16.8763 4.07136 17.2203 4.37713Z" fill="#3A84F3"/></svg>
Finish projects much faster</li>

		  					</ul>

		  				</div>

		  				<div class="wrap">
		  				
		  					<div className="archive-testimonial">

					  				<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."</p>

					  				<Img fluid={localFiles.find(n => n.name == 'placeholder').childImageSharp.fluid}/>

							        <div className="text-content">
							          <h4>Test name</h4>
							          <p>Test title</p>
							        </div>
							    </div>

		  				</div>

		  				{/*<PopupText url="https://calendly.com/kbs-marc/hello" text="Let's Talk" className="button accent"></PopupText>*/}

 						<div className={'visitButton' + (post.portfolioData.linkToSite ? '' : 'hidden')}  dangerouslySetInnerHTML={{ __html: headerButton }} />

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
        portfolioData {
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
