import React from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../../components/layouts/Standard' 

export default function SinglePortfolio({data}) {

	const post = data.allWpPortfolio.nodes[0]

	var headerButton;

	if(post.portfolioData.linkToSite){

		const siteUrl = post.portfolioData.siteUrl.url;
		headerButton = "<a href='" + siteUrl + "' target='_blank' rel='noreferrer' class='button'>Visit Live Site " + '<svg className="right" width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.6"><path d="M6.66667 5.83333C6.66667 5.3731 7.03976 5 7.5 5L14.1667 5C14.6269 5 15 5.3731 15 5.83333V12.5C15 12.9602 14.6269 13.3333 14.1667 13.3333C13.7064 13.3333 13.3333 12.9602 13.3333 12.5V7.84518L6.42259 14.7559C6.09715 15.0814 5.56951 15.0814 5.24408 14.7559C4.91864 14.4305 4.91864 13.9028 5.24408 13.5774L12.1548 6.66667L7.5 6.66667C7.03976 6.66667 6.66667 6.29357 6.66667 5.83333Z" fill="#1F252F"/></g></svg>' +  "</a>";
	}
	else{

		headerButton = '';
	}
	
  	return (

  		<LayoutStandard title={"Case Study: " + post.title} description={post.portfolioData.projectSimpleDescription} image={post.featuredImage}>

	  		<div class="container">

		  		<section className="row page-title vcenter">

		  			<div className="col-8">

		  				<h1>{post.title}</h1>

		  			</div>

		  			<div className={'col-4 right visitButton' + (post.portfolioData.linkToSite ? '' : 'hidden')}  dangerouslySetInnerHTML={{ __html: headerButton }} />

		  		</section>

		  		</div>

		  	<section id="portfolio-gallery">

		  		<div className="container">

			  		<div className="row">

			  			<div className="col-12">

			  				<p>This is the gallery!</p>

			  			</div>

			  		</div>

			  	</div>

		  	</section>

	  		<section className="container">

	  			<div className="row">

		  			<div className="col-8 blog-content">

		  				<div className="wrapper" dangerouslySetInnerHTML={{ __html: post.content }}/>

		  			</div>

		  			<div className="col-4 featured-image">
		  				
		  				<Img fluid={post.portfolioData.sidebarImage.localFile.childImageSharp.fluid} />

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
  }
`
