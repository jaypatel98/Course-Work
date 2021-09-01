public class MyDriver {
    private static void dumpTree(PostfixTree tree)
    {
        try
        {
            System.out.println(tree.inorder() + "=" + tree.evaluate() +
                    " || height=" + tree.height());
        }
        catch (Exception e)
        {
            System.out.println("exception thrown: " + e.getMessage());
        }

    }
    public static void main(String[] args)
    {
        PostfixTree tree;
        int run=0;
        {
            System.out.println("testing " + run++);
            tree = new PostfixTree();
            tree.pushNumber(1);
            tree.pushNumber(2);
            tree.pushNumber(3);
            tree.pushMultiply();
            tree.pushAdd();
            dumpTree(tree);
        }
        {
            System.out.println("testing " + run++);
            tree = new PostfixTree();
            tree.pushNumber(1000);
            tree.pushNumber(100);
            tree.pushNumber(10);
            tree.pushNumber(1);
            tree.pushNumber(0.1);
            tree.pushAdd();
            dumpTree(tree);
            tree.pushAdd();
            dumpTree(tree);
            tree.pushAdd();
            dumpTree(tree);
            tree.pushAdd();
            dumpTree(tree);
        }
        {
            System.out.println("testing " + run++);
            tree = new PostfixTree();
            tree.pushNumber(5);
            tree.pushNumber(10);
            tree.pushSubtract();
            dumpTree(tree);
            tree.pushNumber(6);
            tree.pushNumber(2);
            tree.pushDivide();
            dumpTree(tree);
            tree.pushMultiply();
            dumpTree(tree);
            tree.pushNumber(999);
            dumpTree(tree);
        }
    }
}