import React from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../../components/layouts/Standard' 

export default function SinglePortfolio({data}) {

	const post = data.allWpPortfolio.nodes[0]

	var headerButton;

	if(post.portfolioData.linkToSite){

		const siteUrl = post.portfolioData.siteUrl.url;
		headerButton = "<a href='" + siteUrl + "' target='_blank' rel='noreferrer' class='button'><span class='blinker'></span>Visit Live Site</a>";
	}
	else{

		headerButton = '';
	}
	
  	return (

  		<LayoutStandard title={"Case Study: " + post.title} description={post.portfolioData.projectSimpleDescription} image={post.featuredImage}>

	  		<section className="row vcenter">

	  			<div className="col-8">

	  				<h1>{post.title}</h1>

	  			</div>

	  			<div className={'col-4 right visitButton' + (post.portfolioData.linkToSite ? '' : 'hidden')}  dangerouslySetInnerHTML={{ __html: headerButton }} />

	  		</section>

	  		<section className="row">

	  			
	  			<div className="col-8 blog-content">

	  				<div className="wrapper" dangerouslySetInnerHTML={{ __html: post.content }}/>

	  			</div>

	  			<div className="col-4 featured-image">
	  				
	  				<Img fluid={post.portfolioData.sidebarImage.localFile.childImageSharp.fluid} />

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
