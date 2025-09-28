using Microsoft.Win32;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Remoting.Services;
using System.Text;
using System.Threading.Tasks;

namespace Program1
{
    internal class Program
    {
        static void Main(string[] args)
        {
            //introduction to string , variable , datatypes

            double gk = 100.99;
            string clg = "Saraswati College of engineering khargar";
            char top = '1';

            //bool used in if else 

            Console.Write("Enter your name: ");
            string name = Console.ReadLine();
            Console.Write("Enter your age: ");
            string age = Console.ReadLine();

           

            Console.WriteLine("His Name is " + name);
            Console.WriteLine("Currently he is studing in " + clg + " which is best clg in the world ");
            Console.WriteLine("as a minimum age of " + age);
            Console.WriteLine("as a knowledge of game development " + gk);
            Console.WriteLine("college is on top " + top + " category");

            Console.ReadLine();


             



        }
    }
}
