import React from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import LayoutStandard from '../components/layouts/Standard'


export default function Home({ data }) {

	const localFiles = data.allFile.nodes;

  return (

  		<LayoutStandard>

	  		<section id="homepage-hero" className="row">

	  			<div className="col-7 text-content">

	  				<h1>I design websites that turn <span className="accent">traffic into customers</span>.</h1>
	  				<p style={{maxWidth: '525px'}}>I use UX principles to help SaaS companies <span class="underline">land more trials and minimize churn</span>, and eCommerce stores trying to <span class="underline">land more sales</span>.</p>

	  			</div>

	  			<div className="col-5 hidden-sm">

	  				<div className="homepage-img-wrapper">

	  					<img src="/webpage.svg"/>

	  					<div className="exclamation exclamation-1">

	  						<Img fluid={localFiles.find(n => n.name == 'me-1').childImageSharp.fluid}/>

	  						<p>“This site is so easy to use — <strong>signing up</strong> was a no-brainer!”</p>

	  					</div>

	  					<div className="exclamation exclamation-2">

	  						<Img fluid={localFiles.find(n => n.name == 'me-2').childImageSharp.fluid}/>
	  						<p>“It was so <strong>easy to checkout here</strong>&hellip;I’m never using Amazon again!”</p>

	  					</div>

	  					<div className="exclamation exclamation-3">

	  						<Img fluid={localFiles.find(n => n.name == 'me-3').childImageSharp.fluid}/>
	  						<p>“This software really speaks to me&hellip;better sign up for that <strong>free trial!</strong>”</p>

	  					</div>
	  				</div>

	  			</div>

	  		</section>

	  		<section id="work-sample" className="row">

	  			<div className="col-12">

	  				<h2 className="label">Recent Work <Link to="/portfolio" className="float-right fancy-link">See All Work</Link></h2>

	  			</div>

	  			{data.allWpPortfolio.nodes.map(post => (

		  			<div className="col-4 archive-portfolio">

		  				<Link to={'/portfolio/' + post.slug}>{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>
		  				<Link to={'/portfolio/' + post.slug}><h3>{post.portfolioItems.projectSimpleTitle}</h3></Link>
		  				<p dangerouslySetInnerHTML={{ __html: post.portfolioItems.projectSimpleDescription }}></p>
		  				<Link to={'/portfolio/' + post.slug} className="fancy-link">Read More</Link>

		  			</div>

	  			))}

	  		</section>

  		</LayoutStandard>
  	)
}

export const query = graphql`query{
  allWpPortfolio(
    sort: {fields: [date], order: DESC}
    limit: 3
    filter: {portfolioItems: {showOnHomepage: {eq: true}}}
  ) {
    nodes {
      content
      slug
      featuredImage {
        node {
          localFile {
            childImageSharp {
              fluid {
                ...GatsbyImageSharpFluid
              }
            }
          }
          id
        }
      }
      portfolioItems {
        projectSimpleDescription
        projectSimpleTitle
        results
        showOnHomepage
      }
    }
  }
  allFile(filter: {absolutePath: {regex: "/(\/home)\//"  }}) {
    nodes {
      relativePath
      name
      childImageSharp {
        fluid(maxWidth: 40){
        	...GatsbyImageSharpFluid
        }
      }
    }
  }
}`
